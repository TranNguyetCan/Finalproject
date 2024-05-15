<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiscountController extends AbstractController
{
    #[Route('/discount', name: 'discount')]
    public function index(): Response
    {
        return $this->render('discount/index.html.twig', [
            'products' => '',
        ]);
    }
}
