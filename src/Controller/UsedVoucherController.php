<?php

namespace App\Controller;

use App\Entity\UsedVoucher;
use App\Form\UsedVoucherType;
use App\Repository\UsedVoucherRepository;
use App\Service\VoucherService;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsedVoucherController extends AbstractController
{
    private $voucherService;
    private UsedVoucherRepository $repo;
    public function __construct(VoucherService $voucherService)

    {
        $this->voucherService = $voucherService;
    }

    /**
     * @Route("/usedvoucher", name="apply_voucher")
     */
    public function applyVoucher(Request $request, UsedVoucherRepository $repo): Response
    {
        $vouchers = $repo->findAll();

        // Render view with vouchers data
        return $this->render('used_voucher/index.html.twig', [
            'vouchers' => $vouchers
        ]);

    }
     /**
     * @Route("/add", name="usedvoucher_add")
     */
    public function createAction(Request $req, UsedVoucherRepository $repo): Response
    {

        $uv = new UsedVoucher();
        $form = $this->createForm(UsedVoucherType::class, $uv);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {


            $repo->save($uv, true);
            return $this->redirectToRoute('apply_voucher', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("used_voucher/add.html.twig", [
            'form' => $form->createView()
        ]);
    }
     /**
     * @Route("/edit/{id}", name="usedvoucher_edit")
     */
    public function usedvouchereditAction(Request $req, UsedVoucherRepository $usedVoucherRepository, UsedVoucher $uv): Response
    {
        $formUV = $this->createform(UsedVoucherType::class, $uv);

        $formUV->handleRequest($req);
        if ($formUV->isSubmitted() && $formUV->isValid()) {


            $usedVoucherRepository->save($uv, true);
            return $this->redirectToRoute('apply_voucher', [], Response::HTTP_SEE_OTHER);
        }   
        return $this->render("used_voucher/edit.html.twig", [
            'formUV' => $formUV->createView()
        ]);
    }
    /**
     *  @Route("/delete/{id}", name="usedvoucher_delete", requirements={"id"="\d+"})
    */
    public function deleteAction(Request $req, UsedVoucherRepository $usedVoucherRepository, UsedVoucher $uv): Response
    {
        try{
            $usedVoucherRepository->remove($uv, true);
        }
       catch(ForeignKeyConstraintViolationException $e){
            return $this->render("used_voucher/error.html.twig", [
                'message' => "Can not remove"
            ]);
       }
        return $this->redirectToRoute('apply_voucher', [], Response::HTTP_SEE_OTHER);
    }
    
}
