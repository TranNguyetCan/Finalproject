<?php

namespace App\Controller;

use App\Entity\Size;
use App\Form\ProSizeType;
use App\Form\SizeType;
use App\Form\UserType;
use App\Repository\SizeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/size")
 */
class SizeController extends AbstractController
{
    private SizeRepository $repo;
    public function __construct(SizeRepository $repo)
    {
        $this->repo = $repo;
        
    }

     /**
     * @Route("/", name="size_page")
     */
    public function readAllAction(): Response
    {
        $sz = $this->repo->findAll();
        return $this->render('size/index.html.twig', [
            'size' => $sz
        ]);
    }


    /**
     * @Route("/add", name="add_size")
     */
    public function createAction(Request $req, SizeRepository $repo): Response
    {

        $sz = new Size();
        $formSize = $this->createForm(SizeType::class, $sz);

        $formSize->handleRequest($req);
        if ($formSize->isSubmitted() && $formSize->isValid()) {


            $repo->save($sz, true);
            return $this->redirectToRoute('size_page', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("size/new.html.twig", [
            'formSize' => $formSize->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit_size")
     */
    public function editAction(Request $req, SizeRepository $repo, Size $sz): Response
    {
        $formSz = $this->createform(SizeType::class, $sz);

        $formSz->handleRequest($req);
        if ($formSz->isSubmitted() && $formSz->isValid()) {


            $repo->save($sz, true);
            return $this->redirectToRoute('size_page', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("size/edit.html.twig", [
            'formSz' => $formSz->createView()
        ]);
    }

    /**
     *  @Route("/delete/{id}", name="delete_size", requirements={"id"="\d+"})
     */
    public function deleteAction(Request $req, Size $sz): Response
    {
        $this->repo->remove($sz, true);
        return $this->redirectToRoute('size_page', [], Response::HTTP_SEE_OTHER);
    }

    
    
}
