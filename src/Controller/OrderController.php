<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Voucher;
use App\Enum\OrderStatus;
use App\Form\OrderType;
use App\Form\OrderType1;
use App\Repository\CartRepository;
use App\Repository\OrderDetailRepository;
use App\Repository\OrderRepository;
use App\Repository\ProSizeRepository;
use App\Repository\UserRepository;
use App\Repository\VoucherRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{   
    // #[Route('/order', name: 'app_order')]
    // public function index(): Response
    // {
        

    //     return $this->render('order/index.html.twig', [
    //         'controller_name' => 'OrderController',
    //     ]);
    // }



    /**
     * @Route("/order", name="addOrder", methods={"POST"})
     */
    public function orderAction(Request $req, ManagerRegistry $reg, OrderRepository $orderRepo, CartRepository $cartRepo,
     ProSizeRepository $proSizeRepo, OrderDetailRepository $orderDetailRepository, VoucherRepository $voucherRepository): Response {
        $order = new Order();
        $form = $this->createForm(OrderType1::class, $order);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
    
            $cartItems = $cartRepo->findAll();
            if ($cartItems) {
                //tạo order và lưu vào db
                $total = 0;
                $order->setUsername($this->getUser());
                $order->setDate(new \DateTime());//lấy ngày hiện tại
                // $order->setStatus(OrderStatus::Ordered);
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

        return $this->redirectToRoute('orderConfirm', ['orderId' => $order->getId()]);
    }

    /**
     * @Route("/orderConfirm/{orderId}", name="orderConfirm")
     */ 
    public function orderConfirm(int $orderId, OrderRepository $orderRepository): Response
    {
        $order = $orderRepository->find($orderId);
        $orderDetails = $order->getOrderDetails();

        $total = 0;
        foreach ($orderDetails as $orderDetail) {
            $total += ($orderDetail->getProSize()->getProduct()->getPrice() * $orderDetail->getQuantity());
        }

        

        return $this->render('order/index.html.twig', [
            'order' => $order,
            'total' => $total
        ]);
    }


    /**
     * @Route("/ordertracking", name="ordertracking")
     */ 
    public function ordertracking(OrderRepository $orderRepository): Response
    {



        return $this->render('order_tracking/index.html.twig', [
            'ordertracking' => 'ordertracking',
        ]);
    }

    /**
     * @Route("/orderlist", name="orderlist")
     */
    public function trackOrder(OrderRepository $orderRepository, UserRepository $userRepository): Response
    {

        $user = $this->getUser();

        $userId = $user->getId();
        if (!$userId) {
            throw $this->createNotFoundException('User ID not found');
        }
        $userObject = $userRepository->find($userId);
        // if (!$userObject) {
        //     throw $this->createNotFoundException('User not found');
        // }

        $orders = $userObject->getOrders();

        // If the order doesn't exist, show an error page
        if (!$orders) {
            throw $this->createNotFoundException('Order not found');
        }

        // Render the order tracking template
        return $this->render('order_tracking/index.html.twig', [
            'orders' => $orders,
        ]);
        // return $this->render('order_tracking/check.html.twig', [
        //         'user' => $user->getId(),
        //     ]);
    }

      /**
     * @Route("/orderhistory", name="orderhistory")
     */ 
    public function orderhistory(): Response
    {
        return $this->render('order_history/index.html.twig', [
            'Orderhistory' => 'orderhistory',
        ]);
    }
}
