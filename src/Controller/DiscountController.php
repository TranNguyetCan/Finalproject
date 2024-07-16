<?php

namespace App\Controller;

use App\Entity\Discount;
use App\Form\DiscountType;
use App\Repository\DiscountRepository;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/discount")
 */
class DiscountController extends AbstractController
{
    private DiscountRepository $repo;
    public function __construct(DiscountRepository $repo)
    {
        $this->repo = $repo;
    }
    /**
     * @Route("/", name="discount_page")
     */
    public function readAllAction(): Response
    {
        $d = $this->repo->findAll();
        return $this->render('discount/index.html.twig', [
            'discount' => $d
        ]);
    }
    /**
     * @Route("/add", name="discount_create")
     */
    public function createAction(Request $req, DiscountRepository $repo): Response
    {

        $d = new Discount();
        $formDis = $this->createForm(DiscountType::class, $d);

        $formDis->handleRequest($req);
        if ($formDis->isSubmitted() && $formDis->isValid()) {
            $repo->save($d, true);
            return $this->redirectToRoute('discount_page', [], Response::HTTP_SEE_OTHER);
        }
        $discount = $repo->findAll();
        return $this->render("discount/add.html.twig", [
            'formDis' => $formDis->createView(),
            'discount' => $discount
        ]);
    }
    /**
     * @Route("/edit/{id}", name="discount_edit")
     */
    public function editAction(Request $req, DiscountRepository $repo, Discount $d): Response
    {
        $formDis = $this->createform(DiscountType::class, $d);

        $formDis->handleRequest($req);
        if ($formDis->isSubmitted() && $formDis->isValid()) {


            $repo->save($d, true);
            return $this->redirectToRoute('discount_page', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("discount/edit.html.twig", [
            'formDis' => $formDis->createView()
        ]);
    }
     /**
     *  @Route("/delete/{id}", name="discount_delete", requirements={"id"="\d+"})
     */
    public function deleteAction(Request $req, Discount $d): Response
    {
        try{
            $this->repo->remove($d, true);
        }
       catch( ForeignKeyConstraintViolationException $e){
            return $this->render("discount/error.html.twig", [
                'message' => "Can not remove"
            ]);
       }
        return $this->redirectToRoute('discount_page', [], Response::HTTP_SEE_OTHER);
    }

}
