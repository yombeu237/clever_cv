<?php

namespace App\Entity;

use App\Repository\DureeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DureeRepository::class)]
class Duree
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbr_de_jour = null;

    #[ORM\Column]
    private ?int $montant = null;

    /**
     * @var Collection<int, Abonemment>
     */
    #[ORM\OneToMany(targetEntity: Abonemment::class, mappedBy: 'duree')]
    private Collection $abonemments;

    public function __construct()
    {
        $this->abonemments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrDeJour(): ?int
    {
        return $this->nbr_de_jour;
    }

    public function setNbrDeJour(int $nbr_de_jour): static
    {
        $this->nbr_de_jour = $nbr_de_jour;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * @return Collection<int, Abonemment>
     */
    public function getAbonemments(): Collection
    {
        return $this->abonemments;
    }

    public function addAbonemment(Abonemment $abonemment): static
    {
        if (!$this->abonemments->contains($abonemment)) {
            $this->abonemments->add($abonemment);
            $abonemment->setDuree($this);
        }

        return $this;
    }

    public function removeAbonemment(Abonemment $abonemment): static
    {
        if ($this->abonemments->removeElement($abonemment)) {
            // set the owning side to null (unless already changed)
            if ($abonemment->getDuree() === $this) {
                $abonemment->setDuree(null);
            }
        }

        return $this;
    }
}
