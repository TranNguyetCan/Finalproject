<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/admin/category")
 */
class CateManageController extends AbstractController
{
    private CategoryRepository $repo;
    public function __construct(CategoryRepository $repo)
    {
        $this->repo = $repo;
    }
    /**
     * @Route("/", name="cate_page")
     */
    public function readAllAction(): Response
    {
        $c = $this->repo->findAll();
        return $this->render('cate_manage/index.html.twig', [
            'category' => $c
        ]);
    }

    /**
     * @Route("/add", name="category_create")
     */
    public function createAction(Request $req, CategoryRepository $repo): Response
    {

        $c = new Category();
        $form = $this->createForm(CategoryType::class, $c);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {


            $repo->save($c, true);
            return $this->redirectToRoute('cate_page', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("cate_manage/new.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name="category_edit")
     */
    public function editAction(Request $req, CategoryRepository $repo, Category $c): Response
    {
        $formCate = $this->createform(CategoryType::class, $c);

        $formCate->handleRequest($req);
        if ($formCate->isSubmitted() && $formCate->isValid()) {


            $repo->save($c, true);
            return $this->redirectToRoute('cate_page', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("cate_manage/edit.html.twig", [
            'formCate' => $formCate->createView()
        ]);
    }

    /**
     *  @Route("/delete/{id}", name="category_delete", requirements={"id"="\d+"})
     */
    public function deleteAction(Request $req, Category $c): Response
    {
        $this->repo->remove($c, true);
        return $this->redirectToRoute('cate_page', [], Response::HTTP_SEE_OTHER);
    }
}
