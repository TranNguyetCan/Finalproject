<?php

namespace App\Entity;

use App\Repository\OrderDetailRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderDetailRepository::class)]
class OrderDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orderDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $order = null;


    // #[ORM\ManyToOne(inversedBy: 'orderDetails')]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?Product $product = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'orderDetails')]
    private ?ProSize $proSize = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrders(): ?Order
    {
        return $this->order;
    }

    public function setOrders(?Order $order): self
    {
        $this->order = $order;

        return $this;
    }

    // public function getProducts(): ?Product
    // {
    //     return $this->product;
    // }

    // public function setProducts(?Product $product): self
    // {
    //     $this->product = $product;

    //     return $this;
    // }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

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
