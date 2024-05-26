<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Discount;
use App\Form\DiscountType;
use App\Repository\DiscountRepository;
use App\Repository\ProductRepository;
use App\Repository\ProSizeRepository;

/**
 * @Route("/admin/discount")
 */
class DisManageController extends AbstractController
{
    private DiscountRepository $DiscountRepository;
    public function __construct(DiscountRepository $DiscountRepository)
    {
        $this->DiscountRepository = $DiscountRepository;
    }

    /**
     * @Route("/", name="discount_list")
     */
    public function index(): Response
    {
        $discounts = $this->DiscountRepository->findAll();

        return $this->render('discount_manage/index.html.twig', [
            'discounts' => $discounts,
        ]);
    }

    /**
     * @Route("/create", name="create_discount")
     */
    public function createDiscountAction(Request $req, ManagerRegistry $reg, ProSizeRepository $repoProSize): Response
    {
        $d = new Discount();
        $discountForm = $this->createForm(DiscountType::class, $d);

        $discountForm->handleRequest($req);
        $entity = $reg->getManager();

        if ($discountForm->isSubmitted() && $discountForm->isValid()) {
            // $data = $discountForm->getData($req);
            // $proSize = $repoProSize->find($data->getProSize());
            // dd($proSize);
            // $d->setDeal($data->getDeal());
            // // $d->setProSize($data->getProSize());
            // $d->setStartDate($data->getStartDate());
            // $d->setProSize($proSize);
            // $d->setEndDate($data->getEndDate());
            // $d->setDescription($data->getDescription());

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entity->persist($d);
            // actually executes the queries (i.e. the INSERT query)
            $entity->flush();
        }
        return $this->render('discount_manage/new.html.twig', [
            'form' => $discountForm->createView()
        ]);
    }
     /**
     *  @Route("/{id}", name="discount_delete", requirements={"id"="\d+"})
     */
    public function deleteAction(Request $req, Discount $d): Response
    {
        $this->DiscountRepository->remove($d, true);
        return $this->redirectToRoute('discount_list', [], Response::HTTP_SEE_OTHER);
    }
     /**
     * @Route("/edit/{id}", name="discount_edit")
     */
    public function editAction(Request $req, DiscountRepository $DiscountRepository, Discount $d): Response
    {
        $formDisc = $this->createform(DiscountType::class, $d);

        $formDisc->handleRequest($req);
        if ($formDisc->isSubmitted() && $formDisc->isValid()) {


            $DiscountRepository->save($d, true);
            return $this->redirectToRoute('discount_list', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("discount_manage/edit.html.twig", [
            'formDisc' => $formDisc->createView()
        ]);
    }
}
