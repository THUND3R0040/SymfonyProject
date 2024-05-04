<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $p_name = null;

    #[ORM\Column(length: 255)]
    private ?string $p_doc = null;

    #[ORM\Column(length: 255)]
    private ?string $p_type = null;

    #[ORM\Column(length: 255)]
    private ?string $p_price = null;

    #[ORM\Column(length: 255)]
    private ?string $p_img = null;

    #[ORM\Column(length: 255)]
    private ?string $p_overlay = null;

    #[ORM\Column(length: 255)]
    private ?string $p_ft = null;

    #[ORM\Column(length: 255)]
    private ?string $p_bs = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPName(): ?string
    {
        return $this->p_name;
    }

    public function setPName(string $p_name): static
    {
        $this->p_name = $p_name;

        return $this;
    }

    public function getPDoc(): ?string
    {
        return $this->p_doc;
    }

    public function setPDoc(string $p_doc): static
    {
        $this->p_doc = $p_doc;

        return $this;
    }

    public function getPType(): ?string
    {
        return $this->p_type;
    }

    public function setPType(string $p_type): static
    {
        $this->p_type = $p_type;

        return $this;
    }

    public function getPPrice(): ?string
    {
        return $this->p_price;
    }

    public function setPPrice(string $p_price): static
    {
        $this->p_price = $p_price;

        return $this;
    }

    public function getPImg(): ?string
    {
        return $this->p_img;
    }

    public function setPImg(string $p_img): static
    {
        $this->p_img = $p_img;

        return $this;
    }

    public function getPOverlay(): ?string
    {
        return $this->p_overlay;
    }

    public function setPOverlay(string $p_overlay): static
    {
        $this->p_overlay = $p_overlay;

        return $this;
    }

    public function getPFt(): ?string
    {
        return $this->p_ft;
    }

    public function setPFt(string $p_ft): static
    {
        $this->p_ft = $p_ft;

        return $this;
    }

    public function getPBs(): ?string
    {
        return $this->p_bs;
    }

    public function setPBs(string $p_bs): static
    {
        $this->p_bs = $p_bs;

        return $this;
    }
}
