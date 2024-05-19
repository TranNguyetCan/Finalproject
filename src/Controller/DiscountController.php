<?php

namespace App\Controller;

use App\Repository\DiscountRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/discount")
 */
class DiscountController extends AbstractController
{
    //repository
    private DiscountRepository $repo;
    public function __construct(DiscountRepository $repo)
    {
        $this->repo = $repo;
    }
    /**
     * @Route("/", name="index")
     */
    public function index(ProductRepository $productRepository): Response
    {
        try {
            $products = $productRepository->findAll();
        } catch (\Exception $e) {
            throw new \Exception('Error fetching products or vendor images: ' . $e->getMessage());
        }

        return $this->render('discount/index.html.twig', [
            'products' => $products
        ]);
    }
    /**
     * @Route("/discount/share/{id}", name="sharediscount")
     */
    public function shareProduct($id, DiscountRepository $discountRepository): Response
    {
        $product = $discountRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Product not found.');
        }

        return $this->render('discount/index.html.twig', [
            'product' => $product,
        ]);
    }
}
