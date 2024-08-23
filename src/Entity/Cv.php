<?php

namespace App\Entity;

use App\Repository\CvRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CvRepository::class)]
class Cv
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_creation = null;

    #[ORM\ManyToOne(inversedBy: 'cvs')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'cvs')]
    private ?Template $template = null;

    /**
     * @var Collection<int, Connaissance>
     */
    #[ORM\OneToMany(targetEntity: Connaissance::class, mappedBy: 'cv')]
    private Collection $connaissances;

    /**
     * @var Collection<int, Section>
     */
    #[ORM\OneToMany(targetEntity: Section::class, mappedBy: 'cv')]
    private Collection $sections;

    /**
     * @var Collection<int, CentreInteret>
     */
    #[ORM\OneToMany(targetEntity: CentreInteret::class, mappedBy: 'cv')]
    private Collection $centreInterets;

    /**
     * @var Collection<int, Realisation>
     */
    #[ORM\OneToMany(targetEntity: Realisation::class, mappedBy: 'cv')]
    private Collection $realisations;

    public function __construct()
    {
        $this->connaissances = new ArrayCollection();
        $this->sections = new ArrayCollection();
        $this->centreInterets = new ArrayCollection();
        $this->realisations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): static
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getTemplate(): ?Template
    {
        return $this->template;
    }

    public function setTemplate(?Template $template): static
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @return Collection<int, Connaissance>
     */
    public function getConnaissances(): Collection
    {
        return $this->connaissances;
    }

    public function addConnaissance(Connaissance $connaissance): static
    {
        if (!$this->connaissances->contains($connaissance)) {
            $this->connaissances->add($connaissance);
            $connaissance->setCv($this);
        }

        return $this;
    }

    public function removeConnaissance(Connaissance $connaissance): static
    {
        if ($this->connaissances->removeElement($connaissance)) {
            // set the owning side to null (unless already changed)
            if ($connaissance->getCv() === $this) {
                $connaissance->setCv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Section>
     */
    public function getSections(): Collection
    {
        return $this->sections;
    }

    public function addSection(Section $section): static
    {
        if (!$this->sections->contains($section)) {
            $this->sections->add($section);
            $section->setCv($this);
        }

        return $this;
    }

    public function removeSection(Section $section): static
    {
        if ($this->sections->removeElement($section)) {
            // set the owning side to null (unless already changed)
            if ($section->getCv() === $this) {
                $section->setCv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CentreInteret>
     */
    public function getCentreInterets(): Collection
    {
        return $this->centreInterets;
    }

    public function addCentreInteret(CentreInteret $centreInteret): static
    {
        if (!$this->centreInterets->contains($centreInteret)) {
            $this->centreInterets->add($centreInteret);
            $centreInteret->setCv($this);
        }

        return $this;
    }

    public function removeCentreInteret(CentreInteret $centreInteret): static
    {
        if ($this->centreInterets->removeElement($centreInteret)) {
            // set the owning side to null (unless already changed)
            if ($centreInteret->getCv() === $this) {
                $centreInteret->setCv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Realisation>
     */
    public function getRealisations(): Collection
    {
        return $this->realisations;
    }

    public function addRealisation(Realisation $realisation): static
    {
        if (!$this->realisations->contains($realisation)) {
            $this->realisations->add($realisation);
            $realisation->setCv($this);
        }

        return $this;
    }

    public function removeRealisation(Realisation $realisation): static
    {
        if ($this->realisations->removeElement($realisation)) {
            // set the owning side to null (unless already changed)
            if ($realisation->getCv() === $this) {
                $realisation->setCv(null);
            }
        }

        return $this;
    }
}
