<?php

namespace App\Entity;

use App\Repository\MailcontactsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MailcontactsRepository::class)]
class Mailcontacts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateEnvoi = null;

    #[ORM\Column(length: 255)]
    private ?string $objet = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\Column]
    private ?int $important = null;

    #[ORM\Column]
    private ?int $idEducateurs = null;

    #[ORM\Column]
    private ?int $supprimer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEnvoi(): ?\DateTimeInterface
    {
        return $this->dateEnvoi;
    }

    public function setDateEnvoi(\DateTimeInterface $dateEnvoi): static
    {
        $this->dateEnvoi = $dateEnvoi;

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): static
    {
        $this->objet = $objet;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getImportant(): ?int
    {
        return $this->important;
    }

    public function setImportant(int $important): static
    {
        $this->important = $important;

        return $this;
    }

    public function getIdEducateurs(): ?int
    {
        return $this->id_educateurs;
    }

    public function setIdEducateurs(int $idEducateurs): static
    {
        $this->idEducateurs = $idEducateurs;

        return $this;
    }

    public function getSupprimer(): ?int
    {
        return $this->supprimer;
    }

    public function setSupprimer(int $supprimer): static
    {
        $this->supprimer = $supprimer;

        return $this;
    }
}
