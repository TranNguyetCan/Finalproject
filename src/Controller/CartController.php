<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Repository\CartRepository;
use App\Repository\ProductRepository;
use App\Repository\ProSizeRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cart")
 */
class CartController extends AbstractController
{
    private CartRepository $repo;
    public function __construct(CartRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @Route("/", name="shoppingCart")
     */
    public function cartAction(): Response
    {
        $user = $this->getUser();
        $carts = $this->repo->showCart($user);

        return $this->render('cart/index.html.twig', ['carts' => $carts]);
    }

    // Create a new one
    /**
     * @Route("/add", name="addCart", methods={"POST"})
     */
    public function addCartAction(Request $req, ProSizeRepository $repoProSize): Response
    {
        // Call function above
        $req = $this->transformJsonBody($req);

        $user = $this->getUser();
        $count = $req->get('count');
        $pro_size_id = $req->get('proSizeId');
        $proSizes = $repoProSize->find($pro_size_id);

        // Query to  find $product of this user exists or not
        //It returns an array with only one line (index: 0)
        $findCart = $this->repo->findCartById($user, $proSizes);

        // If its not exists, add new
        if ($findCart == null) :
            $newCart = new Cart();
            $newCart->setUser($user);
            $newCart->setCount($count);
            $newCart->setProSize($proSizes);

            $this->repo->save($newCart, true);
        else :
            // It exists update Count
            $cart = $this->repo->find($findCart[0]);

            if ($cart->getCount() + $count > $proSizes->getQuantity()) :
                $cart->setCount($proSizes->getQuantity());
            else :
                $cart->setCount($cart->getCount() + $count);
            endif;
            $this->repo->save($cart, true);
        endif;
        return new JsonResponse();
    }

    public function transformJsonBody(Request $re)
    {
        $data = json_decode($re->getContent(), true);
        if ($data === null) {
            return $re;
        }
        $re->request->replace($data);
        return $re;
    }


    /**
     * @Route("/cart/delete/{id}", name="deleteCart", methods={"DELETE"})
     */
    public function deleteCartAction(int $id, ManagerRegistry $reg): Response
    {
        $user = $this->getUser();
        $cart = $this->repo->removeCart($id, $user);

        $entity = $reg->getManager();
        foreach ($cart as $c) :
            $entity->remove($c);
            $entity->flush();
        endforeach;

        return new JsonResponse();
    }


    // Chang number in Cart
    /**
     * @Route("/change", name="changeAction", methods={"POST"})
     */
    public function minus(Request $req, ManagerRegistry $reg, ProSizeRepository $repoProSize): Response
    {
        $cartId = $req->request->get('cartId');
        $action = $req->request->get('action');
        $cart = $this->repo->find($cartId);

        $entity = $reg->getManager();
        if ($action == "minus") :
            if ($qty = $cart->getCount() - 1 > 0) :
                $cart->setCount($qty);
                $entity->persist($cart);
            endif;
        else :
            $qtyInStock = $repoProSize->find($cart->getProSize());
            if (($qty = $cart->getCount() + 1) <= $qtyInStock->getQuantity()) :
                $cart->setCount($qty);
                $entity->persist($cart);
            endif;
        endif;

        $entity->flush();

        return $this->redirectToRoute('shoppingCart');
    }
    
}
