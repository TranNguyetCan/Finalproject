<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $count = null;

    // #[ORM\ManyToOne(inversedBy: 'carts')]
    // private ?Product $product = null;

    #[ORM\ManyToOne(inversedBy: 'carts')]   
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'carts')]
    private ?ProSize $proSize = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    // public function getProduct(): ?Product
    // {
    //     return $this->product;
    // }

    // public function setProduct(?Product $product): self
    // {
    //     $this->product = $product;

    //     return $this;
    // }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
}
