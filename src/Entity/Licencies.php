<?php

namespace App\Entity;

use App\Repository\LicenciesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LicenciesRepository::class)]
class Licencies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numeroLicence = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\ManyToOne(inversedBy: 'licencies')]
    private ?Contacts $Contacts = null;

    #[ORM\ManyToOne(inversedBy: 'licencies')]
    private ?Categories $Categories = null;

    #[ORM\OneToMany(mappedBy: 'Licencies', targetEntity: Educateurs::class)]
    private Collection $educateurs;

    public function __construct()
    {
        $this->educateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroLicence(): ?int
    {
        return $this->numeroLicence;
    }

    public function setNumeroLicence(int $numeroLicence): static
    {
        $this->numeroLicence = $numeroLicence;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }


    public function getContacts(): ?Contacts
    {
        return $this->Contacts;
    }

    public function setContacts(?Contacts $Contacts): static
    {
        $this->Contacts = $Contacts;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->Categories;
    }

    public function setCategories(?Categories $Categories): static
    {
        $this->Categories = $Categories;

        return $this;
    }

    /**
     * @return Collection<int, Educateurs>
     */
    public function getEducateurs(): Collection
    {
        return $this->educateurs;
    }

    public function addEducateur(Educateurs $educateur): static
    {
        if (!$this->educateurs->contains($educateur)) {
            $this->educateurs->add($educateur);
            $educateur->setLicencies($this);
        }

        return $this;
    }

    public function removeEducateur(Educateurs $educateur): static
    {
        if ($this->educateurs->removeElement($educateur)) {
            // set the owning side to null (unless already changed)
            if ($educateur->getLicencies() === $this) {
                $educateur->setLicencies(null);
            }
        }

        return $this;
    }
}
