<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Voucher;
use App\Form\VoucherType;
use App\Repository\VoucherRepository;
use App\Repository\ProductRepository;
use App\Repository\ProSizeRepository;

/**
 * @Route("/admin/voucher")
 */
class DisManageController extends AbstractController
{
    private VoucherRepository $VoucherRepository;
    public function __construct(VoucherRepository $VoucherRepository)
    {
        $this->VoucherRepository = $VoucherRepository;
    }

    /**
     * @Route("/", name="Voucher_list")
     */
    public function index(): Response
    {
        $Vouchers = $this->VoucherRepository->findAll();

        return $this->render('Voucher_manage/index.html.twig', [
            'Vouchers' => $Vouchers,
        ]);
    }

    /**
     * @Route("/create", name="create_Voucher")
     */
    public function createVoucherAction(Request $req, ManagerRegistry $reg, ProSizeRepository $repoProSize): Response
    {
        $d = new Voucher();
        $VoucherForm = $this->createForm(VoucherType::class, $d);

        $VoucherForm->handleRequest($req);
        $entity = $reg->getManager();

        if ($VoucherForm->isSubmitted() && $VoucherForm->isValid()) {
            // $data = $VoucherForm->getData($req);
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
        return $this->render('Voucher_manage/new.html.twig', [
            'form' => $VoucherForm->createView()
        ]);
    }
     /**
     *  @Route("/{id}", name="Voucher_delete", requirements={"id"="\d+"})
     */
    public function deleteAction(Request $req, Voucher $d): Response
    {
        $this->VoucherRepository->remove($d, true);
        return $this->redirectToRoute('Voucher_list', [], Response::HTTP_SEE_OTHER);
    }
     /**
     * @Route("/edit/{id}", name="Voucher_edit")
     */
    public function editAction(Request $req, VoucherRepository $VoucherRepository, Voucher $d): Response
    {
        $formDisc = $this->createform(VoucherType::class, $d);

        $formDisc->handleRequest($req);
        if ($formDisc->isSubmitted() && $formDisc->isValid()) {


            $VoucherRepository->save($d, true);
            return $this->redirectToRoute('Voucher_list', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("Voucher_manage/edit.html.twig", [
            'formDisc' => $formDisc->createView()
        ]);
    }
}
