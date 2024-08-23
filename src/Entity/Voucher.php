<?php

namespace App\Entity;

use App\Repository\VoucherRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Collection;

#[ORM\Entity(repositoryClass: VoucherRepository::class)]
class Voucher
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $deal = null;

    #[ORM\ManyToOne(targetEntity: ProSize::class)]
    #[ORM\JoinColumn(name: 'product_id', referencedColumnName: 'id', nullable: false)]
    private ?ProSize $proSize = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTime $start_date = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTime $end_date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $percentage = null;

    #[ORM\OneToMany(mappedBy: 'vouchers', targetEntity: Order::class)]
    private \Doctrine\Common\Collections\Collection $orderLst;

    public function __construct()
    {
        $this->orderLst = new ArrayCollection();
    }

  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeal(): ?int
    {
        return $this->deal;
    }

    public function setDeal(int $deal): self
    {
        $this->deal = $deal;

        return $this;
    }

    public function getProSize(): ?ProSize
    {
        return $this->proSize;
    }

    public function setProSize(?ProSize $proSize): self
    {
        $this->proSize = $proSize;

        return $this;
    }

    public function getStartDate(): ?\DateTime
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTime $start_date): self
    {
        $this->start_date = $start_date;
        return $this;
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTime $end_date): self
    {
        $this->end_date = $end_date;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPercentage(): ?int
    {
        return $this->percentage;
    }

    public function setPercentage(int $percentage): self
    {
        $this->percentage = $percentage;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection<int, Order>
     */
    public function getOrderLst(): \Doctrine\Common\Collections\Collection
    {
        return $this->orderLst;
    }

    public function addOrderLst(Order $orderLst): self
    {
        if (!$this->orderLst->contains($orderLst)) {
            $this->orderLst->add($orderLst);
            $orderLst->setVouchers($this);
        }

        return $this;
    }

    public function removeOrderLst(Order $orderLst): self
    {
        if ($this->orderLst->removeElement($orderLst)) {
            // set the owning side to null (unless already changed)
            if ($orderLst->getVouchers() === $this) {
                $orderLst->setVouchers(null);
            }
        }

        return $this;
    }
}
