<?php

namespace App\Entity;

use App\Repository\MetierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MetierRepository::class)]
class Metier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'metier', targetEntity: Artisane::class)]
    private Collection $artisanes;

    public function __construct()
    {
        $this->artisanes = new ArrayCollection();
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

    /**
     * @return Collection<int, Artisane>
     */
    public function getArtisanes(): Collection
    {
        return $this->artisanes;
    }

    public function addArtisane(Artisane $artisane): self
    {
        if (!$this->artisanes->contains($artisane)) {
            $this->artisanes->add($artisane);
            $artisane->setMetier($this);
        }

        return $this;
    }

    public function removeArtisane(Artisane $artisane): self
    {
        if ($this->artisanes->removeElement($artisane)) {
            // set the owning side to null (unless already changed)
            if ($artisane->getMetier() === $this) {
                $artisane->setMetier(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getNom();
    }
}
