<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdministrationController extends AbstractController
{
    private ProductRepository $repo;
    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }
    // /**
    //  * @Route("/product", name="proManage_show")
    //  */
    // public function readAllAction(): Response
    // {
    //     $products = $this->repo->findAll();
    //     return $this->render('product/index.html.twig', [
    //         'products' => $products
    //     ]);
    // }


    /**
     * @Route("/order", name="order_page")
     */
    public function orderAction(): Response
    {
        return $this->render('admin/order.html.twig');
    }

    /**
     * @Route("/category", name="cate_page")
     */
    public function categoryAction(): Response
    {
        return $this->render('admin/category.html.twig');
    }

    /**
     * @Route("/supplier", name="supp_page")
     */
    public function supplierAction(): Response
    {
        return $this->render('admin/supplier.html.twig');
    }

    /**
     * @Route("/productManagement", name="pro_page")
     */
    public function productAction(): Response
    {
        return $this->render('admin/product.html.twig');
    }
    
}
