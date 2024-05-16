<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class WishlistController extends AbstractController
{
    /**
     * @Route("/wishlist", name="wishlist_index")
     */

    public function index(): Response
    {
        return $this->render('wishlist/index.html.twig', [
            'controller_name' => 'WishlistController',
        ]);
    }
    /**
     * @Route("/wishlist/{id}", name="add_wishlist")
     */
    public function addWishlist($id, ProductRepository $productRepo, Request $req): Response
    {
        $user = $this->getUser();
        if (!$user) {
            // return $this->redirectToRoute('app_login');
        }
        $product = $productRepo->find($id);
        $wishlist = 
    }
}
