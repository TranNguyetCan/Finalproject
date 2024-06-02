<?php

namespace App\Entity;

use App\Repository\DiscountRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiscountRepository::class)]
class Discount
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $DiscountCode = null;

    #[ORM\Column(length: 255)]
    private ?string $DiscountPercentage = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Star_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $End_date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiscountCode(): ?string
    {
        return $this->DiscountCode;
    }

    public function setDiscountCode(string $DiscountCode): self
    {
        $this->DiscountCode = $DiscountCode;

        return $this;
    }

    public function getDiscountPercentage(): ?string
    {
        return $this->DiscountPercentage;
    }

    public function setDiscountPercentage(string $DiscountPercentage): self
    {
        $this->DiscountPercentage = $DiscountPercentage;

        return $this;
    }

    public function getStarDate(): ?\DateTimeInterface
    {
        return $this->Star_date;
    }

    public function setStarDate(\DateTimeInterface $Star_date): self
    {
        $this->Star_date = $Star_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->End_date;
    }

    public function setEndDate(\DateTimeInterface $End_date): self
    {
        $this->End_date = $End_date;

        return $this;
    }
}
