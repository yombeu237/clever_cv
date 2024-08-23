<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length:255, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?int $code_postale = null;

    #[ORM\Column(length:255, nullable: true)]
    private ?string $photo = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lien_linkedln = null;

    #[ORM\Column(length: 255)]
    private ?string $profil = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_naissance = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu_naissance = null;

    #[ORM\Column(length: 255)]
    private ?string $nationalite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $num_permis = null;

    #[ORM\Column(length:255, nullable: true)]
    private ?string $sexe = null;

    #[ORM\Column(length:255, nullable: true)]
    private ?string $site_internet = null;

    /**
     * @var Collection<int, Cv>
     */
    #[ORM\OneToMany(targetEntity: Cv::class, mappedBy: 'user')]
    private Collection $cvs;

    /**
     * @var Collection<int, Souscrire>
     */
    #[ORM\OneToMany(targetEntity: Souscrire::class, mappedBy: 'user')]
    private Collection $souscrires;

    /**
     * @var Collection<int, InfoPerso>
     */
    #[ORM\OneToMany(targetEntity: InfoPerso::class, mappedBy: 'user')]
    private Collection $infoPersos;

    public function __construct()
    {
        $this->cvs = new ArrayCollection();
        $this->souscrires = new ArrayCollection();
        $this->infoPersos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostale(): ?int
    {
        return $this->code_postale;
    }

    public function setCodePostale(int $code_postale): static
    {
        $this->code_postale = $code_postale;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getLienLinkedln(): ?string
    {
        return $this->lien_linkedln;
    }

    public function setLienLinkedln(?string $lien_linkedln): static
    {
        $this->lien_linkedln = $lien_linkedln;

        return $this;
    }

    public function getProfil(): ?string
    {
        return $this->profil;
    }

    public function setProfil(string $profil): static
    {
        $this->profil = $profil;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieu_naissance;
    }

    public function setLieuNaissance(string $lieu_naissance): static
    {
        $this->lieu_naissance = $lieu_naissance;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): static
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getNumPermis(): ?string
    {
        return $this->num_permis;
    }

    public function setNumPermis(?string $num_permis): static
    {
        $this->num_permis = $num_permis;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): static
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getSiteInternet(): ?string
    {
        return $this->site_internet;
    }

    public function setSiteInternet(string $site_internet): static
    {
        $this->site_internet = $site_internet;

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
            $cv->setUser($this);
        }

        return $this;
    }

    public function removeCv(Cv $cv): static
    {
        if ($this->cvs->removeElement($cv)) {
            // set the owning side to null (unless already changed)
            if ($cv->getUser() === $this) {
                $cv->setUser(null);
            }
        }

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
            $souscrire->setUser($this);
        }

        return $this;
    }

    public function removeSouscrire(Souscrire $souscrire): static
    {
        if ($this->souscrires->removeElement($souscrire)) {
            // set the owning side to null (unless already changed)
            if ($souscrire->getUser() === $this) {
                $souscrire->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InfoPerso>
     */
    public function getInfoPersos(): Collection
    {
        return $this->infoPersos;
    }

    public function addInfoPerso(InfoPerso $infoPerso): static
    {
        if (!$this->infoPersos->contains($infoPerso)) {
            $this->infoPersos->add($infoPerso);
            $infoPerso->setUser($this);
        }

        return $this;
    }

    public function removeInfoPerso(InfoPerso $infoPerso): static
    {
        if ($this->infoPersos->removeElement($infoPerso)) {
            // set the owning side to null (unless already changed)
            if ($infoPerso->getUser() === $this) {
                $infoPerso->setUser(null);
            }
        }

        return $this;
    }
}
