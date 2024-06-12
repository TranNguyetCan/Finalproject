<?php

namespace App\Entity;

use App\Repository\BranchRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BranchRepository::class)]
class Branch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $branchName = null;

    #[ORM\Column(length: 255)]
    private ?string $branchAddress = null;

    #[ORM\Column(length: 255)]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $product = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBranchName(): ?string
    {
        return $this->branchName;
    }

    public function setBranchName(string $branchName): self
    {
        $this->branchName = $branchName;

        return $this;
    }

    public function getBranchAddress(): ?string
    {
        return $this->branchAddress;
    }

    public function setBranchAddress(string $branchAddress): self
    {
        $this->branchAddress = $branchAddress;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getProduct(): ?string
    {
        return $this->product;
    }

    public function setProduct(string $product): self
    {
        $this->product = $product;

        return $this;
    }
}
