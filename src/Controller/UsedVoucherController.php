<?php

namespace App\Controller;

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
     * @Route("/apply-voucher", name="apply_voucher")
     */
    public function applyVoucher(Request $request): Response
    {
        $cusName = $request->get('cusName');
        $deal = $request->get('deal');
        $Id = $request->get('Id');
        $voucher = $request->get('voucher_code');

        // return new Response('Voucher applied successfully.');
        return $this->render('Voucher/index.html.twig', [
            'voucher' => $voucher,
            'cusName' => $cusName,
            'deal' => $deal,
            'Id' => $Id,         
        ]);

    }
}
