<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrestationRepository::class)]
class Prestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Artisane::class, inversedBy: 'prestations')]
    private Collection $artisanes;

    public function __construct()
    {
        $this->artisanes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
        }

        return $this;
    }

    public function removeArtisane(Artisane $artisane): self
    {
        $this->artisanes->removeElement($artisane);

        return $this;
    }

    public function __toString(): string
    {
        return $this->getDescription();
    }
}
