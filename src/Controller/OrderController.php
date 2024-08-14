<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order')]
    public function index(): Response
    {
        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }
    /**
     * @Route("/ordertrackcing", name="ordertracking")
     */ 
    public function ordertracking(): Response
    {
        return $this->render('order_tracking/index.html.twig', [
            'ordertracking' => 'ordertracking',
        ]);
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
