<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;

class DiscountController extends AbstractController
{
    /**
     * @Route("/discount", name="discount_index")
     */
    public function index(ProductRepository $productRepository): Response
    {
        try {
            $products = $productRepository->findAll();
        } catch (\Exception $e) {
            throw new \Exception('Error fetching products or vendor images: ' . $e->getMessage());
        }

        if (!$products) {
            throw ('Products or vendor images not found');
        }

        return $this->render('discount/index.html.twig', [
            'products' => $products
        ]);
    }
}
