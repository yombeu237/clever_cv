<?php

namespace App\Entity;

use App\Repository\TemplateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TemplateRepository::class)]
class Template
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(nullable: true)]
    private ?int $prix = null;

    #[ORM\ManyToOne(inversedBy: 'templates')]
    private ?ModeDePaiement $modepaiement = null;

    #[ORM\ManyToOne(inversedBy: 'templates')]
    private ?Abonemment $abonnement = null;

    /**
     * @var Collection<int, Categorie>
     */
    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'templates')]
    private Collection $categorieCv;

    /**
     * @var Collection<int, Cv>
     */
    #[ORM\OneToMany(targetEntity: Cv::class, mappedBy: 'template')]
    private Collection $cvs;

    public function __construct()
    {
        $this->categorieCv = new ArrayCollection();
        $this->cvs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(?int $prix): static
    {
        $this->prix = $prix;

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

    public function getAbonnement(): ?Abonemment
    {
        return $this->abonnement;
    }

    public function setAbonnement(?Abonemment $abonnement): static
    {
        $this->abonnement = $abonnement;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategorieCv(): Collection
    {
        return $this->categorieCv;
    }

    public function addCategorieCv(Categorie $categorieCv): static
    {
        if (!$this->categorieCv->contains($categorieCv)) {
            $this->categorieCv->add($categorieCv);
        }

        return $this;
    }

    public function removeCategorieCv(Categorie $categorieCv): static
    {
        $this->categorieCv->removeElement($categorieCv);

        return $this;
    }

    /**
     * @return Collection<int, Cv>
     */
    public function getCvs(): Collection
    {
        return $this->cvs;
    }

    public function addCv(Cv $cv): static
    {
        if (!$this->cvs->contains($cv)) {
            $this->cvs->add($cv);
            $cv->setTemplate($this);
        }

        return $this;
    }

    public function removeCv(Cv $cv): static
    {
        if ($this->cvs->removeElement($cv)) {
            // set the owning side to null (unless already changed)
            if ($cv->getTemplate() === $this) {
                $cv->setTemplate(null);
            }
        }

        return $this;
    }
}
