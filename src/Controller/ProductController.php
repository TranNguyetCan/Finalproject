<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\ProSizeRepository;
use App\Repository\SizeRepository;
use App\Repository\SupplierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    private ProductRepository $repo;
    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @Route("/", name="showProduct")
     */
    public function showProductAction(Request $req, SupplierRepository $repoSupp, CategoryRepository $repoCate, ProSizeRepository $repoPs, SizeRepository $repoSize): Response
    {
        $title = "Not Found";
        $categories = $repoCate->findAll();
        $sizes = $repoSize->findAll();
        $suppliers = $repoSupp->findAll();

        $proSizes = $repoPs->findNameSize([], [
            'id' => 'DESC'
        ]);

        $sort_by = $req->query->get('sort_by');
        $order = $req->query->get('order');
        $btnSearch = $req->query->get('btnSearch');
        $value = $req->query->get('value');

        if (isset($btnSearch)) :
            $products = $this->repo->searchByName($value);
            $title = "Results";
        elseif (isset($sort_by)) :
            if ($sort_by == 'name') :
                $products = $this->repo->findByName($order);
                $title = "Sort by name";
            endif;
            if ($sort_by == 'price') :
                $products = $this->repo->findByPrice($order);
                $title = "Sort by price";
            endif;
            if ($sort_by == 'category') :
                $products = $this->repo->findByCate($order);
                $title = "Sort by categpory";
            endif;
            if ($sort_by == 'supplier') :
                $products = $this->repo->findBySupp($order);
                $title = "Sort by supplier";
            endif;
            if ($sort_by == 'size') :
                $products = $this->repo->findBySize($order);
                $title = "Sort by supplier";
            endif;
            if ($sort_by == 'gender') :
                if ($order == "men") :
                    $products = $this->repo->findByGender(0);
                    $title = "Sort by Men's clothing";
                else :
                    $products = $this->repo->findByGender(1);
                    $title = "Sort by Women's clothing";
                endif;
            endif;
        else :
            $products = $this->repo->findAll();
            $title = "All product";
        endif;

        return $this->render('product/show.html.twig', [
            'products' => $products,
            'catefories' => $categories,
            'suppliers' => $suppliers,
            'sizes' => $sizes,
            'proSizes' => $proSizes,
            'title' => $title
        ]);
    }

    /**
     * @Route("/detail/{id}", name="proDetail_page")
     */
    public function productDetailAction(Product $p, ProSizeRepository $repoPs): Response
    {
        $proSizes = $repoPs->findNameSize([], [
            'id' => 'DESC'
        ]);

        return $this->render('product/detail.html.twig', [
            'product' => $p,
            'proSizes' => $proSizes
        ]);
    }
}
