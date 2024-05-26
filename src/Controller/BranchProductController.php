<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BranchProductController extends AbstractController
{
    #[Route('/branch/product', name: 'app_branch_product')]
    public function index(): Response
    {
        return $this->render('branch_product/index.html.twig', [
            'controller_name' => 'BranchProductController',
        ]);
    }
}
