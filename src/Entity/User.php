<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $u_name = null;

    #[ORM\Column(length: 40)]
    private ?string $u_email = null;

    #[ORM\Column(length: 255)]
    private ?string $u_password = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $isAdmin = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $isActive = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $regDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUName(): ?string
    {
        return $this->u_name;
    }

    public function setUName(string $u_name): static
    {
        $this->u_name = $u_name;

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

    public function getUPassword(): ?string
    {
        return $this->u_password;
    }

    public function setUPassword(string $u_password): static
    {
        $this->u_password = $u_password;

        return $this;
    }

    public function getIsAdmin(): ?int
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(int $isAdmin): static
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    public function getIsActive(): ?int
    {
        return $this->isActive;
    }

    public function setIsActive(int $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getRegDate(): ?\DateTimeInterface
    {
        return $this->regDate;
    }

    public function setRegDate(\DateTimeInterface $regDate): static
    {
        $this->regDate = $regDate;

        return $this;
    }
}
