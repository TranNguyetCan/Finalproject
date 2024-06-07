<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderDetail;
use App\Entity\CreditCard;
use App\Entity\Paypal;
use App\Entity\ProSize;
use App\Entity\User;
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
     * @Route("/payment", name="payment_page", methods={"POST"})
     */
    public function paymentAction(CartRepository $repoCart, UserRepository $repoUser): Response
    {
        $o = new Order();
        $orderForm = $this->createForm(OrderType::class, $o, [
            'action' => $this->generateUrl('addOrder')
        ]);

        $user = $this->getUser();
        $products = $repoCart->showCart($user);

        return $this->render('payment/index.html.twig', [
            // Display product and Calculate the total price
            'products' => $products,
            // Display customer's infomation to set into Order
            'user' => $user,
            'orderForm' => $orderForm->createView(  )
        ]);
    }

    /**
     * @Route("/order", name="addOrder", methods={"POST"})
     */
    public function orderAction(
        Request $req,
        ManagerRegistry $reg,
        CartRepository $repoCart,
        ProSizeRepository $repoProSize,
        OrderDetailRepository $repoOd
    ): Response {
        $o = new Order();
        $orderForm = $this->createForm(OrderType::class, $o);

        $orderForm->handleRequest($req);
        $entity = $reg->getManager();

        $user = $this->getUser();
        $data = $orderForm->getData($req);

        $o->setDate(new \DateTime());
        $o->setTotal($data->getTotal());
        $o->setDeliveryLocal($data->getDeliveryLocal());
        $o->setStatus($data->isStatus());
        $o->setUsername($user);
        $o->setCusName($data->getCusName());
        $o->setCusPhone($data->getCusPhone());

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entity->persist($o);
        // actually executes the queries (i.e. the INSERT query)
        $entity->flush();

        // Save Order Detail
        // It returns two-dimensional array
        $carts = $repoCart->getCartOfCurrentUser($user);

        foreach ($carts as $c) :
            $orderDetail = new OrderDetail();
            // Find object ProSize pof this proSizeId
            $p = $repoProSize->find($c['proSizeId']);
            $orderDetail->setProSize($p);
            $orderDetail->setQuantity($c['qty']);
            $orderDetail->setOrders($o);

            $repoOd->save($orderDetail, true);

            // Update quantity in Stock
            $p->setQuantity($p->getQuantity() - $c['qty']);
        endforeach;

        // Delete Cart
        $entity = $reg->getManager();
        foreach ($carts as $c) :
            // Find object Cart based on two-dimensional array $carts
            $cart = $repoCart->find($c['cartId']);
            $entity->remove($cart, true);
            $entity->flush();
        endforeach;

        // Notification success
        $this->addFlash(
            'success',
            'Order successully'
        );
        
        return $this->redirectToRoute("shoppingCart");
    }

    /**
     * @Route("/checkout", name="checkout")
     */
    public function checkout(Request $request, PaymentRepository $repo): Response
    {
        $paymentform = $this->createForm(PaymentType::class);

        $paymentform->handleRequest($request);
            $listPayment = $repo->findAll();
    
            // Xử lý dữ liệu khi form được gửi đi
            // $formData = $paymentform->getData();
            // $selectedPayment = $formData['pa'];
            return $this->render('payment/choosePayment.html.twig', ['listPayment' => $listPayment]);
            // xử lý theo phương thức thanh toán được chọn
            
            // return $this->redirectToRoute('payment');
        

      
    }

    // /**
    //  * @Route("/payment", name="payment")
    //  */
    // public function paymentSuccess(): Response
    // {
    //     return new Response('Payment Successful!');
    // }
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


}
