<?php

// src/Entity/Voiture.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $marque;

    #[ORM\Column(type: 'string', length: 255)]
    private $modele;

    #[ORM\Column(type: 'integer')]
    private $annee;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $prixActuel;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private $ancienPrix;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $note;


    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    #[ORM\Column(type: 'boolean')]
    private $isPublished = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    
    // Getters & Setters

    public function getPrixActuel(): ?float
    {
        return $this->prixActuel;
    }

    public function setPrixActuel(float $prixActuel): self
    {
        $this->prixActuel = $prixActuel;
        return $this;
    }

    public function getAncienPrix(): ?float
    {
        return $this->ancienPrix;
    }

    public function setAncienPrix(?float $ancienPrix): self
    {
        $this->ancienPrix = $ancienPrix;
        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;
        return $this;
    }

   

    public function isPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;
        return $this;
    }

}
