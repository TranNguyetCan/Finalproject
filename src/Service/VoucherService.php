<?php
namespace App\Service;
use App\Entity\UsedVoucher;
use App\Repository\UsedVoucherRepository;
use Doctrine\ORM\EntityManagerInterface;

class VoucherService
{
    private $usedVoucherRepository;
    private $entityManager;

    public function __construct(UsedVoucherRepository $usedVoucherRepository, EntityManagerInterface $entityManager)
    {
        $this->usedVoucherRepository = $usedVoucherRepository;
        $this->entityManager = $entityManager;
    }

    public function hasCustomerUsedVoucher(string $voucher, string $cusName, string $deal, string $UseAt ): bool
    {
        $usedVoucher = $this->usedVoucherRepository->findOneBy([
            // 'Id' => $Id,
            // 'CusName' => $cusName,/
            'Deal' => $deal,
            'Voucher' => $voucher,
            'UseAt' => $UseAt,
        ]);

        return $usedVoucher !== null;
    }

}
?>