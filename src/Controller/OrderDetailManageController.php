<?php

namespace App\Controller;

use App\Repository\OrderDetailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderDetailManageController extends AbstractController
{

    /**
     * @Route("/admin/orderdetail/{id}", name="orderdetail_page")
     */
    public function findOrderDetail(OrderDetailRepository $repo, int $id): Response
    {
        $orderDetails = $repo->findOrderDetail(['id' => $id]);

        return $this->render('orderDetail_manage/index.html.twig', [
            'orderDetails' => $orderDetails
        ]);

        return $this->redirectToRoute('order_page');
    }
}
