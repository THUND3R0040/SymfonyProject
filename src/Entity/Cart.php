<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $comm_id = null;

    #[ORM\Column(length: 40)]
    private ?string $u_email = null;

    #[ORM\Column(length: 40)]
    private ?string $p_name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $addDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommId(): ?int
    {
        return $this->comm_id;
    }

    public function setCommId(int $comm_id): static
    {
        $this->comm_id = $comm_id;

        return $this;
    }

    public function getUEmail(): ?string
    {
        return $this->u_email;
    }

    public function setUEmail(string $u_email): static
    {
        $this->u_email = $u_email;

        return $this;
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

    public function getAddDate(): ?\DateTimeInterface
    {
        return $this->addDate;
    }

    public function setAddDate(\DateTimeInterface $addDate): static
    {
        $this->addDate = $addDate;

        return $this;
    }
}
