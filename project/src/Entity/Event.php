<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTime $date_debut = null;

    #[ORM\Column]
    private ?\DateTime $date_fin = null;

    #[ORM\Column(length: 255)]
    private ?string $salle = null;

    #[ORM\Column(length: 255)]
    private ?string $intervenant = null;

    #[ORM\Column]
    private ?bool $actif = false;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Promo $promo = null;

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

    public function getDateDebut(): ?\DateTime
    {
        return $this->date_debut;
    }
    public function setDateDebut(\DateTime $date_debut): static
    {
        $this->date_debut = $date_debut;
        return $this;
    }

    public function getDateFin(): ?\DateTime
    {
        return $this->date_fin;
    }
    public function setDateFin(\DateTime $date_fin): static
    {
        $this->date_fin = $date_fin;
        return $this;
    }

    public function getSalle(): ?string
    {
        return $this->salle;
    }
    public function setSalle(string $salle): static
    {
        $this->salle = $salle;
        return $this;
    }

    public function getIntervenant(): ?string
    {
        return $this->intervenant;
    }
    public function setIntervenant(string $intervenant): static
    {
        $this->intervenant = $intervenant;
        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }
    public function setActif(bool $actif): static
    {
        $this->actif = $actif;
        return $this;
    }

    public function getPromo(): ?Promo
    {
        return $this->promo;
    }
    public function setPromo(?Promo $promo): static
    {
        $this->promo = $promo;
        return $this;
    }
}
