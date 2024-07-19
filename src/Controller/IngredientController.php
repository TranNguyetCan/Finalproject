<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/ingredient")
 */
class IngredientController extends AbstractController
{
    private IngredientRepository $repo;
    public function __construct(IngredientRepository $repo)
    {
        $this->repo = $repo;
    }
    /**
     * @Route("/", name="ingredient_page")
     */
    public function readAllAction(): Response
    {
        $i = $this->repo->findAll();
        return $this->render('ingredient/index.html.twig', [
            'ingredient' => $i
        ]);
    }
      /**
     * @Route("/add", name="ingredient_create")
     */
    public function createAction(Request $req, IngredientRepository $repo): Response
    {

        $i = new Ingredient();
        $formIng = $this->createForm(IngredientType::class, $i);

        $formIng->handleRequest($req);
        if ($formIng->isSubmitted() && $formIng->isValid()) {


            $repo->save($i, true);
            return $this->redirectToRoute('ingredient_page', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("ingredient/new.html.twig", [
            'formIng' => $formIng->createView()
        ]);
    }
     /**
     * @Route("/edit/{id}", name="ingredient_edit")
     */
    public function editAction(Request $req, IngredientRepository $repo, Ingredient $i): Response
    {
        $formIng = $this->createform(IngredientType::class, $i);

        $formIng->handleRequest($req);
        if ($formIng->isSubmitted() && $formIng->isValid()) {


            $repo->save($i, true);
            return $this->redirectToRoute('ingredient_page', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("ingredient/edit.html.twig", [
            'formIng' => $formIng->createView()
        ]);
    }
    /**
     *  @Route("/delete/{id}", name="ingredient_delete", requirements={"id"="\d+"})
     */
    public function deleteAction(Request $req, Ingredient $i): Response
    {
        try{
            $this->repo->remove($i, true);
        }
       catch(ForeignKeyConstraintViolationException $e){
            return $this->render("ingredident/error.html.twig", [
                'message' => "Can not remove"
            ]);
       }
        return $this->redirectToRoute('ingredident', [], Response::HTTP_SEE_OTHER);
    }

}
