<?php

namespace App\Entity;

use App\Repository\ArtisaneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArtisaneRepository::class)]
class Artisane
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $prenom = null;

    #[ORM\Column]
    #[Assert\Length(
        min:1,
        max:20)]
    private ?string $telephone = null;

    #[ORM\Column(length: 200)]
    #[Assert\Email(
        message: "Le mail {{ value }} est incorrecte.",
    )]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotCompromisedPassword]
   
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 100)]
    private ?string $nomEntreprise = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $aneesExperience = null;

    #[ORM\Column]
    private ?bool $activation = null;

    #[ORM\Column(length: 100)]
    private ?string $horaires = null;

    #[ORM\ManyToMany(targetEntity: Prestation::class, mappedBy: 'artisanes')]
    private Collection $prestations;

    #[ORM\OneToMany(mappedBy: 'artisane', targetEntity: Image::class)]
    private Collection $images;

   

    #[ORM\ManyToOne(inversedBy: 'artisanes')]
    private ?Metier $metier = null;

    public function __construct()
    {
        $this->prestations = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNomEntreprise(): ?string
    {
        return $this->nomEntreprise;
    }

    public function setNomEntreprise(string $nomEntreprise): self
    {
        $this->nomEntreprise = $nomEntreprise;

        return $this;
    }

    public function getAneesExperience(): ?\DateTimeInterface
    {
        return $this->aneesExperience;
    }

    public function setAneesExperience(\DateTimeInterface $aneesExperience): self
    {
        $this->aneesExperience = $aneesExperience;

        return $this;
    }

    public function isActivation(): ?bool
    {
        return $this->activation;
    }

    public function setActivation(bool $activation): self
    {
        $this->activation = $activation;

        return $this;
    }

    public function getHoraires(): ?string
    {
        return $this->horaires;
    }

    public function setHoraires(string $horaires): self
    {
        $this->horaires = $horaires;

        return $this;
    }

    /**
     * @return Collection<int, Prestation>
     */
    public function getPrestations(): Collection
    {
        return $this->prestations;
    }

    public function addPrestation(Prestation $prestation): self
    {
        if (!$this->prestations->contains($prestation)) {
            $this->prestations->add($prestation);
            $prestation->addArtisane($this);
        }

        return $this;
    }

    public function removePrestation(Prestation $prestation): self
    {
        if ($this->prestations->removeElement($prestation)) {
            $prestation->removeArtisane($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setArtisane($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getArtisane() === $this) {
                $image->setArtisane(null);
            }
        }

        return $this;
    }


    public function getMetier(): ?Metier
    {
        return $this->metier;
    }

    public function setMetier(?Metier $metier): self
    {
        $this->metier = $metier;

        return $this;
    }
    
    public function __toString(): string
    {
        return $this->designation;
    }
}
