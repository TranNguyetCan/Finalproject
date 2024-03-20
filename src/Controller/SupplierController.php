<?php

namespace App\Controller;

use App\Entity\Supplier;
use App\Form\SupplierType;
use App\Repository\SupplierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/supplier")
 */
class SupplierController extends AbstractController
{

    private SupplierRepository $repo;
    public function __construct(SupplierRepository $repo)
    {
        $this->repo = $repo;
    }
    // Read All
    /**
     * @Route("/", name="supp_page", )
     */
    public function readAllAction(): Response
    {
        //  tìm hết nhưng xếp theo id giảm dần 
        $sup = $this->repo->findBy([], ['id' => 'DESC']);
        $data = [];
        foreach ($sup as $s) { //dung foreach de tranh lien ket vong trong bang Product
            $data[] =
                [
                    'id' => $s->getId(),
                    'name' => $s->getName(),
                    'phone' => $s->getPhone(),
                    'email' => $s->getEmail(),
                    'address' => $s->getAddress(),
                ];
        }
        // return $this->json($data);
        return $this->render('supp_manage/index.html.twig', [
            'suppliers' => $data
        ]);
    }


    /**
     * @Route("/add", name="addSupp_page")
     */
    public function createAction(Request $req, SupplierRepository $repo): Response
    {
        $s = new Supplier();
        $formSupp = $this->createForm(SupplierType::class, $s);

        $formSupp->handleRequest($req);
        if ($formSupp->isSubmitted() && $formSupp->isValid()) {
            $repo->save($s, true);
            return $this->redirectToRoute('supp_page', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("supp_manage/new.html.twig", [
            'formSupp' => $formSupp->createView()
        ]);
    }


    /**
     * @Route("/edit/{id}", name="editSupp_page")
     */
    public function editAction(Request $req, SluggerInterface $slugger, SupplierRepository $repo, Supplier $s): Response
    {
        $formSupp = $this->createForm(SupplierType::class, $s);

        $formSupp->handleRequest($req);
        if ($formSupp->isSubmitted() && $formSupp->isValid()) {

            $repo->save($s, true);
            return $this->redirectToRoute('supp_page', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("supp_manage/edit.html.twig", [
            'formSupp' => $formSupp->createView()
        ]);
    }

    /**
     *  @Route("/delete/{id}", name="deleteSupp_page", requirements={"id"="\d+"})
     */
    public function deleteAction(Request $req, Supplier $s): Response
    {
        $this->repo->remove($s, true);
        return $this->redirectToRoute('supp_page', [], Response::HTTP_SEE_OTHER);
    }
}
