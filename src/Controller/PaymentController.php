<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderDetail;
use App\Entity\ProSize;
use App\Entity\User;
use App\Form\OrderType;
use App\Repository\CartRepository;
use App\Repository\OrderDetailRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\ProSizeRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

date_default_timezone_set('Asia/Ho_Chi_Minh');
class PaymentController extends AbstractController
{
    private OrderRepository $repo;
    public function __construct(OrderRepository $repo)
    {
        $this->repo = $repo;
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
}
