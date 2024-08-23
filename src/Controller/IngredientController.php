<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Repository\CategoryRepository;
use App\Repository\IngredientRepository;
use App\Repository\ProSizeRepository;
use App\Repository\SizeRepository;
use App\Repository\SupplierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/ingredient")
 */
class IngredientController extends AbstractController
{
    private IngredientRepository $repo;
    public function __construct(IngredientRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @Route("/", name="showIngre")
     */
    public function showIngreAction(Request $req, SupplierRepository $repoSupp, CategoryRepository $repoCate, ProSizeRepository $repoPs, SizeRepository $repoSize): Response
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
            $ingredients = $this->repo->searchByName($value);
            $title = "Results";
        elseif (isset($sort_by)) :
            if ($sort_by == 'name') :
                $ingredients = $this->repo->findByName($order);
                $title = "Sort by name";
            endif;
            if ($sort_by == 'price') :
                $ingredients = $this->repo->findByPrice($order);
                $title = "Sort by price";
            endif;
            if ($sort_by == 'category') :
                $ingredients = $this->repo->findByCate($order);
                $title = "Sort by categpory";
            endif;
            if ($sort_by == 'supplier') :
                $ingredients = $this->repo->findBySupp($order);
                $title = "Sort by supplier";
            endif;
            if ($sort_by == 'size') :
                $ingredients = $this->repo->findBySize($order);
                $title = "Sort by supplier";
            endif;
            if ($sort_by == 'gender') :
                if ($order == "men") :
                    $ingredients = $this->repo->findByGender(0);
                    $title = "Sort by Men's clothing";
                else :
                    $ingredients = $this->repo->findByGender(1);
                    $title = "Sort by Women's clothing";
                endif;
            endif;
        else :
            $ingredients = $this->repo->findAll();
            $title = "All product";
        endif;

        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients,
            'catefories' => $categories,
            'suppliers' => $suppliers,
            'sizes' => $sizes,
            'proSizes' => $proSizes,
            'title' => $title
        ]);
    }

    /**
     * @Route("/detail/{id}", name="IngreDetail_page")
     */
    public function ingreDetailAction(Ingredient $i, ProSizeRepository $repoPs): Response
    {
        $proSizes = $repoPs->findNameSize([], [
            'id' => 'DESC'
        ]);

        return $this->render('ingredient/detail.html.twig', [
            'ingredient' => $i,
            'proSizes' => $proSizes
        ]);
    }
    /**
     * @Route("/feature", name="ingredient_fratured")
     */
    public function featuredIngredients(IngredientRepository $ingredientRepository): Response
    {
        $i = $ingredientRepository->findBy(['isFeatured' => true]);

        return $this->render('product/show.html.twig', [
            'ingredient' => $i,
        ]);
    }
}
