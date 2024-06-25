<?php

namespace App\Controller;

use App\Entity\UsedVoucher;
use App\Form\UsedVoucherType;
use App\Repository\UsedVoucherRepository;
use App\Service\VoucherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsedVoucherController extends AbstractController
{
    private $voucherService;
    public function __construct(VoucherService $voucherService)
    {
        $this->voucherService = $voucherService;
    }

    /**
     * @Route("/usedvoucher", name="apply_voucher")
     */
    public function applyVoucher(Request $request): Response
    {
        $cusName = $request->get('cusName');
        $deal = $request->get('deal');
        $Id = $request->get('Id');
        $voucher = $request->get('voucher_code');

        // return new Response('Voucher applied successfully.');
        return $this->render('used_voucher/index.html.twig', [
            'voucher' => $voucher,
            'cusName' => $cusName,
            'deal' => $deal,
            'Id' => $Id,         
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
}
