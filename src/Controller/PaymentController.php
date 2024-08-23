<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderDetail;
use App\Entity\CreditCard;
use App\Entity\Paypal;
use App\Entity\ProSize;
use App\Entity\User;
use App\Enum\OrderStatus;
use App\Form\OrderType;
use App\Form\PaymentType;
use App\Form\CreditCardType;
use App\Form\PaypalType;
use App\Form\UserType;
use App\Repository\CartRepository;
use App\Repository\OrderDetailRepository;
use App\Repository\OrderRepository;
use App\Repository\PaymentRepository;
use App\Repository\ProductRepository;
use App\Repository\ProSizeRepository;
use App\Repository\UserRepository;
use App\Repository\VoucherRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

date_default_timezone_set('Asia/Ho_Chi_Minh');
class PaymentController extends AbstractController
{
    private $em;
    private $kernel;
    private OrderRepository $repo;
    public function __construct(OrderRepository $repo, EntityManagerInterface $em, KernelInterface $kernel)
    {
        $this->repo = $repo;
        $this->em = $em;
        $this->kernel = $kernel;
    }
    // Show payment page
    /**
     * @Route("/payment", name="payment_page", methods={"POST","GET"})
     */
    public function paymentAction(Request $req,CartRepository $repoCart, UserRepository $repoUser, VoucherRepository $voucherRepository,
    CartRepository $cartRepo,OrderRepository $orderRepo, ProSizeRepository $proSizeRepo, OrderDetailRepository $orderDetailRepository): Response
    {
        $order = new Order();
        $orderForm = $this->createForm(OrderType::class, $order);
        $orderForm->handleRequest($req);
        if ($orderForm->isSubmitted() && $orderForm->isValid()) {
    
            $cartItems = $cartRepo->findAll();
            if ($cartItems) {
                //tạo order và lưu vào db
                $total = 0;
                $order->setUsername($this->getUser());
                $order->setDate(new \DateTime());//lấy ngày hiện tại
                $order->setStatus(OrderStatus::Ordered);
                //Lưu order lần 1 để tạo đơn hàng và lấy mã đơn hàng đưa vô OrderDetail
                $orderRepo->save($order, true);
                
                foreach ($cartItems as $cartItem) {
                    //lấy prosize từ cart
                    $proSize = $proSizeRepo->find($cartItem->getProSize()->getId());
                    $total += $proSize->getProduct()->getPrice() * $cartItem->getCount();
                    //lưu orderDetail lại
                    $orderDetailRepository->addProductToOrder($order, $proSize, $cartItem->getCount());

                    //xóa cart
                    $cartRepo->remove($cartItem, true);
                }
                $totalDiscount = $total - ($total * ($order->getVouchers()->getPercentage() / 100));
                
                $order->setTotal($totalDiscount);
                //Lưu order lần cuối để chốt đơn hàng
                $orderRepo->save($order, true);
            }
        }
        $user = $this->getUser();
        $products = $repoCart->showCart($user);
        $vouchers = $voucherRepository->findAll();

        return $this->render('payment/index.html.twig', [
            // Display product and Calculate the total price
            'products' => $products,
            'vouchers' => $vouchers,
            // Display customer's infomation to set into Order
            'user' => $user,
            'orderForm' => $orderForm->createView(  )
        ]);
    }

    

    /**
     * @Route("/checkout", name="checkout")
     */
    public function checkout(Request $request, PaymentRepository $repo): Response
    {
        $paymentform = $this->createForm(PaymentType::class);

        $paymentform->handleRequest($request);
            $listPayment = $repo->findAll();
    
            // Process data when form is submitted
            // $formData = $paymentform->getData();
            // $selectedPayment = $formData['pa'];
            return $this->render('payment/choosePayment.html.twig', ['listPayment' => $listPayment]);
            // xử lý theo phương thức thanh toán được chọn
            
            // return $this->redirectToRoute('payment');
        

      
    }

   
    /**
     * @Route("/loginPaypal", name="paypal_login")
     */
    public function Paypal(Request $request): Response
    {
        $paypal = $this->createForm(PaypalType::class);
        $paypal->handleRequest($request);
    
        return $this->render('payment/login.html.twig', [

        'paypal' => $paypal->createView(  )
    ]);
       
 }
    // /**
    //  * @Route("/paypal-login", name="paypal_login")
    //  */
    // public function paypalLogin(): Response
    // {
    //     // Đường dẫn đến trang đăng nhập PayPal
    //     $paypalLoginUrl = 'https://www.paypal.com/signin';

    //     return $this->redirect($paypalLoginUrl);
    // }

    // /**
    //  * @Route("/payment", name="Paypal")
    //  */
    // public function Paypal(Request $request): Response
    // {
    //     $paypal = $this->createForm(PaypalType::class);
    //     $paypal->handleRequest($request);
    
    //     return $this->render('payment/paypal.html.twig', [

    //     'paypal' => $paypal->createView(  )
    // ]);
       
    // }

    /**
     * @Route("/signin", name="signIn")
     */
    public function signIn(
        Request $req,
        UserPasswordHasherInterface $paypalPasswordHasher,
        EntityManagerInterface $entityManager
    ): Response {
        $paypal = new Paypal();
        $paypalForm = $this->createForm(PaypalType::class, $paypal);
        $paypalForm->handleRequest($req);

        if ($paypalForm->isSubmitted() && $paypalForm->isValid()) {
            // Encode the plain password
            $paypal->setPassword(
                $paypalPasswordHasher->hashPassword(
                    $paypal,
                    $paypalForm->get('password')->getData()
                )
            );

            // Persist user data to the database
            $entityManager->persist($paypal);
            $entityManager->flush();

            // Redirect to PayPal login
            return $this->redirectToRoute('paypal_login');
        }

        return $this->render('payment/signIn.html.twig', [
            'paypalForm' => $paypalForm->createView(),
        ]);
    }
     /**
     * @Route("successful", name="successful")
     */
    public function paymentSuccess(): Response
    {
        return new Response('Payment Successful!');
    }


}
