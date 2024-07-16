<?php

namespace App\Entity;

use App\Repository\UsedVoucherRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\FormBuilderInterface;

#[ORM\Entity(repositoryClass: UsedVoucherRepository::class)]
class UsedVoucher
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $CusName = null;

    #[ORM\Column(length: 255)]
    private ?string $Voucher = null;

    #[ORM\Column(length: 255)]
    private ?string $Deal = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $UseAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCusName(): ?string
    {
        return $this->CusName;
    }

    public function setCusName(string $CusName): self
    {
        $this->CusName = $CusName;

        return $this;
    }

    public function getVoucher(): ?string
    {
        return $this->Voucher;
    }

    public function setVoucher(string $Voucher): self
    {
        $this->Voucher = $Voucher;

        return $this;
    }

    public function getDeal(): ?string
    {
        return $this->Deal;
    }

    public function setDeal(string $Deal): self
    {
        $this->Deal = $Deal;

        return $this;
    }

    public function getUseAt(): ?\DateTimeImmutable
    {
        return $this->UseAt;
    }

    public function setUseAt(\DateTimeImmutable $UseAt): self
    {
        $this->UseAt = $UseAt;

        return $this;
    }
}
