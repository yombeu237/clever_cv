<?php

namespace App\Entity;

use App\Repository\AbonemmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbonemmentRepository::class)]
class Abonemment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    /**
     * @var Collection<int, Souscrire>
     */
    #[ORM\OneToMany(targetEntity: Souscrire::class, mappedBy: 'abonnement')]
    private Collection $souscrires;

    #[ORM\ManyToOne(inversedBy: 'abonemments')]
    private ?Duree $duree = null;

    /**
     * @var Collection<int, ModeDePaiement>
     */
    #[ORM\OneToMany(targetEntity: ModeDePaiement::class, mappedBy: 'abonnement')]
    private Collection $modeDePaiements;

    /**
     * @var Collection<int, Template>
     */
    #[ORM\OneToMany(targetEntity: Template::class, mappedBy: 'abonnement')]
    private Collection $templates;

    public function __construct()
    {
        $this->souscrires = new ArrayCollection();
        $this->modeDePaiements = new ArrayCollection();
        $this->templates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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
            $souscrire->setAbonnement($this);
        }

        return $this;
    }

    public function removeSouscrire(Souscrire $souscrire): static
    {
        if ($this->souscrires->removeElement($souscrire)) {
            // set the owning side to null (unless already changed)
            if ($souscrire->getAbonnement() === $this) {
                $souscrire->setAbonnement(null);
            }
        }

        return $this;
    }

    public function getDuree(): ?Duree
    {
        return $this->duree;
    }

    public function setDuree(?Duree $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * @return Collection<int, ModeDePaiement>
     */
    public function getModeDePaiements(): Collection
    {
        return $this->modeDePaiements;
    }

    public function addModeDePaiement(ModeDePaiement $modeDePaiement): static
    {
        if (!$this->modeDePaiements->contains($modeDePaiement)) {
            $this->modeDePaiements->add($modeDePaiement);
            $modeDePaiement->setAbonnement($this);
        }

        return $this;
    }

    public function removeModeDePaiement(ModeDePaiement $modeDePaiement): static
    {
        if ($this->modeDePaiements->removeElement($modeDePaiement)) {
            // set the owning side to null (unless already changed)
            if ($modeDePaiement->getAbonnement() === $this) {
                $modeDePaiement->setAbonnement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Template>
     */
    public function getTemplates(): Collection
    {
        return $this->templates;
    }

    public function addTemplate(Template $template): static
    {
        if (!$this->templates->contains($template)) {
            $this->templates->add($template);
            $template->setAbonnement($this);
        }

        return $this;
    }

    public function removeTemplate(Template $template): static
    {
        if ($this->templates->removeElement($template)) {
            // set the owning side to null (unless already changed)
            if ($template->getAbonnement() === $this) {
                $template->setAbonnement(null);
            }
        }

        return $this;
    }
}
