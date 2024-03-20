<?php

namespace App\Entity;

use App\Repository\ProSupRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProSupRepository::class)]
class ProSup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateToDeliver = null;

    #[ORM\ManyToOne(inversedBy: 'proSups')]
    private ?Product $product = null;

    #[ORM\ManyToOne(inversedBy: 'proSups')]
    private ?Supplier $supplier = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateToDeliver(): ?\DateTimeInterface
    {
        return $this->dateToDeliver;
    }

    public function setDateToDeliver(\DateTimeInterface $dateToDeliver): self
    {
        $this->dateToDeliver = $dateToDeliver;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function setSupplier(?Supplier $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }
}
