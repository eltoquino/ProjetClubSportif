<?php

namespace App\Entity;

use App\Repository\DetmailcontactsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetmailcontactsRepository::class)]
class Detmailcontacts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idMailcontact = null;

    #[ORM\Column]
    private ?int $idContacts = null;

    #[ORM\Column]
    private ?int $supprimer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMailcontact(): ?int
    {
        return $this->idMailcontact;
    }

    public function setIdMailcontact(int $idMailcontact): static
    {
        $this->idMailcontact = $idMailcontact;

        return $this;
    }

    public function getIdContacts(): ?int
    {
        return $this->idContacts;
    }

    public function setIdContacts(int $idContacts): static
    {
        $this->idContacts = $idContacts;

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
