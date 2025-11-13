<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 50, unique: true)]
    private string $serie;

    #[ORM\Column(type: "date")]
    private \DateTimeInterface $dateMiseEnMarche;

    #[ORM\ManyToOne(inversedBy: 'voitures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Modele $modele = null;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private float $prixJour;

    #[ORM\OneToMany(mappedBy: "voiture", targetEntity: Location::class, cascade: ["remove"])]
    private Collection $locations;

    public function __construct()
    {
        $this->locations = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSerie(): string
    {
        return $this->serie;
    }

    public function setSerie(string $serie): self
    {
        $this->serie = $serie;
        return $this;
    }

    public function getDateMiseEnMarche(): \DateTimeInterface
    {
        return $this->dateMiseEnMarche;
    }

    public function setDateMiseEnMarche(\DateTimeInterface $date): self
    {
        $this->dateMiseEnMarche = $date;
        return $this;
    }

    // ✅ FIXED
    public function getModele(): ?Modele
    {
        return $this->modele;
    }

    public function setModele(?Modele $modele): self
    {
        $this->modele = $modele;
        return $this;
    }

    public function getPrixJour(): float
    {
        return $this->prixJour;
    }

    public function setPrixJour(float $prixJour): self
    {
        $this->prixJour = $prixJour;
        return $this;
    }

    /** @return Collection<int, Location> */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Location $location): self
    {
        if (!$this->locations->contains($location)) {
            $this->locations[] = $location;
            $location->setVoiture($this);
        }
        return $this;
    }

    public function removeLocation(Location $location): self
    {
        if ($this->locations->removeElement($location)) {
            if ($location->getVoiture() === $this) {
                $location->setVoiture(null);
            }
        }
        return $this;
    }
}
