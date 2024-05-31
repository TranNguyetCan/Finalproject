<?php

namespace App\Controller;

use App\Entity\Wishlist;
use App\Repository\ProductRepository;
use App\Repository\WishlistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/wishlist")
 */

class WishlistController extends AbstractController
{
    /**
     * @Route("/", name="wishlist_index")
     */

    public function index(WishlistRepository $wishlistRepo): Response
    {
        $user = $this->getUser();
        if (!$user) {
            // return $this->redirectToRoute('app_login');
        }
        $wishlistItems = $wishlistRepo->findBy(['user' => $user]);
        $products = [];
        foreach ($wishlistItems as $item) {
            $products[] = $item->getProduct();
        }
        return $this->render('wishlist/index.html.twig', [
            'products' => $products,
        ]);
    }
    /**
     * @Route("/add/{id}", name="add_wishlist")
     */
    public function addWishlist($id, ProductRepository $productRepo, WishlistRepository $wishlistRepo, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
        $product = $productRepo->find($id);
        if (!$product) {
            throw $this->createNotFoundException('Product not found');
        }

        $existingWishlist = $wishlistRepo->findOneBy([
            'user' => $user,
            'product' => $product
        ]);

        if (!$existingWishlist) {
            $wishlist = new Wishlist();
            $wishlist->setUser($user);
            $wishlist->setProduct($product);

            $em->persist($wishlist);
            $em->flush();
        }

        return $this->redirectToRoute('wishlist_index');
    }

    // public function addWishlist($id, ProductRepository $productRepo, EntityManagerInterface $em): Response
    // {
    //     $user = $this->getUser();
    //     if (!$user) {
    //         // return $this->redirectToRoute('app_login');
    //     }

    //     $product = $productRepo->find($id);
    //     if (!$product) {
    //         throw $this->createNotFoundException('Product not found');
    //     }

    //     $existingWishlist = $user->getWishlists()->filter(function ($wishlist) use ($product) {
    //         return $wishlist->getProduct() === $product;
    //     })->first();

    //     if (!$existingWishlist) {
    //         $wishlist = new Wishlist();
    //         $wishlist->setUser($user);
    //         $wishlist->setProduct($product);

    //         $em->persist($wishlist);
    //         $em->flush();
    //     }

    //     return $this->redirectToRoute('wishlist_index');
    // }
    //  /**
    //  * @Route("/edit/{id}", name="wishlist_edit")
    //  */
    // public function editAction(Request $req, WishlistRepository $repo, Wishlist $w): Response
    // {
    //     $formWish = $this->createform(WishlistType ::class, $c);

    //     $formCate->handleRequest($req);
    //     if ($formCate->isSubmitted() && $formCate->isValid()) {


    //         $repo->save($c, true);
    //         return $this->redirectToRoute('cate_page', [], Response::HTTP_SEE_OTHER);
    //     }
    //     return $this->render("cate_manage/edit.html.twig", [
    //         'formCate' => $formCate->createView()
    //     ]);
    // }

}
