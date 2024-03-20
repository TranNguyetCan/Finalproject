<?php

namespace App\Entity;

use App\Repository\SizeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SizeRepository::class)]
class Size
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $descriptions = null;

    #[ORM\OneToMany(mappedBy: 'size', targetEntity: ProSize::class)]
    private Collection $proSizes;

    public function __construct()
    {
        $this->proSizes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescriptions(): ?string
    {
        return $this->descriptions;
    }

    public function setDescriptions(string $descriptions): self
    {
        $this->descriptions = $descriptions;

        return $this;
    }

    /**
     * @return Collection<int, ProSize>
     */
    public function getProSizes(): Collection
    {
        return $this->proSizes;
    }

    public function addProSize(ProSize $proSize): self
    {
        if (!$this->proSizes->contains($proSize)) {
            $this->proSizes->add($proSize);
            $proSize->setSize($this);
        }

        return $this;
    }

    public function removeProSize(ProSize $proSize): self
    {
        if ($this->proSizes->removeElement($proSize)) {
            // set the owning side to null (unless already changed)
            if ($proSize->getSize() === $this) {
                $proSize->setSize(null);
            }
        }

        return $this;
    }
}
