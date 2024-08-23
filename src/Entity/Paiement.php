<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaiementRepository::class)]
class Paiement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $montant = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_paiement = null;

    /**
     * @var Collection<int, Souscrire>
     */
    #[ORM\OneToMany(targetEntity: Souscrire::class, mappedBy: 'paiement')]
    private Collection $souscrires;

    #[ORM\ManyToOne(inversedBy: 'paiements')]
    private ?ModeDePaiement $modepaiement = null;

    public function __construct()
    {
        $this->souscrires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDatePaiement(): ?\DateTimeInterface
    {
        return $this->date_paiement;
    }

    public function setDatePaiement(\DateTimeInterface $date_paiement): static
    {
        $this->date_paiement = $date_paiement;

        return $this;
    }

    /**
     * @return Collection<int, Souscrire>
     */
    public function getSouscrires(): Collection
    {
        return $this->souscrires;
    }

    public function addSouscrire(Souscrire $souscrire): static
    {
        if (!$this->souscrires->contains($souscrire)) {
            $this->souscrires->add($souscrire);
            $souscrire->setPaiement($this);
        }

        return $this;
    }

    public function removeSouscrire(Souscrire $souscrire): static
    {
        if ($this->souscrires->removeElement($souscrire)) {
            // set the owning side to null (unless already changed)
            if ($souscrire->getPaiement() === $this) {
                $souscrire->setPaiement(null);
            }
        }

        return $this;
    }

    public function getModepaiement(): ?ModeDePaiement
    {
        return $this->modepaiement;
    }

    public function setModepaiement(?ModeDePaiement $modepaiement): static
    {
        $this->modepaiement = $modepaiement;

        return $this;
    }
}
