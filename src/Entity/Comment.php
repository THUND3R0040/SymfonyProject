<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $c_id = null;

    #[ORM\Column(length: 255)]
    private ?string $c_email = null;

    #[ORM\Column(length: 255)]
    private ?string $c_content = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $isAnswered = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCId(): ?int
    {
        return $this->c_id;
    }

    public function setCId(int $c_id): static
    {
        $this->c_id = $c_id;

        return $this;
    }

    public function getCEmail(): ?string
    {
        return $this->c_email;
    }

    public function setCEmail(string $c_email): static
    {
        $this->c_email = $c_email;

        return $this;
    }

    public function getCContent(): ?string
    {
        return $this->c_content;
    }

    public function setCContent(string $c_content): static
    {
        $this->c_content = $c_content;

        return $this;
    }

    public function getIsAnswered(): ?int
    {
        return $this->isAnswered;
    }

    public function setIsAnswered(int $isAnswered): static
    {
        $this->isAnswered = $isAnswered;

        return $this;
    }
}
