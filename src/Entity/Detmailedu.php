<?php

namespace App\Entity;

use App\Repository\DetmaileduRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetmaileduRepository::class)]
class Detmailedu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idMailedu = null;

    #[ORM\Column]
    private ?int $idEducateurs = null;

    #[ORM\Column]
    private ?bool $supprimer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMailedu(): ?int
    {
        return $this->idMailedu;
    }

    public function setIdMailedu(int $idMailedu): static
    {
        $this->idMailedu = $idMailedu;

        return $this;
    }

    public function getIdEducateurs(): ?int
    {
        return $this->idEducateurs;
    }

    public function setIdEducateurs(int $idEducateurs): static
    {
        $this->idEducateurs = $idEducateurs;

        return $this;
    }

    public function isSupprimer(): ?bool
    {
        return $this->supprimer;
    }

    public function setSupprimer(bool $supprimer): static
    {
        $this->supprimer = $supprimer;

        return $this;
    }
}
