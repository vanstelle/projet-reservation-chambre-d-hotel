<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChambreRepository::class)]
class Chambre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $drescription = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $options = null;

    #[ORM\Column(length: 255)]
    private ?string $photo1 = null;

    #[ORM\Column(length: 255)]
    private ?string $photo2 = null;

    #[ORM\Column(length: 255)]
    private ?string $photo3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo5 = null;

    #[ORM\Column(nullable: true)]
    private ?string $hotel = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHotel(): ?int
    {
        return $this->hotel;
    }

    public function setHotel(int $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }


    public function getDrescription(): ?string
    {
        return $this->drescription;
    }

    public function setDrescription(string $drescription): self
    {
        $this->drescription = $drescription;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getOptions(): ?string
    {
        return $this->options;
    }

    public function setOptions(string $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function getPhoto1(): ?string
    {
        return $this->photo1;
    }

    public function setPhoto1(string $photo1): self
    {
        $this->photo1 = $photo1;

        return $this;
    }

    public function getPhoto2(): ?string
    {
        return $this->photo2;
    }

    public function setPhoto2(string $photo2): self
    {
        $this->photo2 = $photo2;

        return $this;
    }

    public function getPhoto3(): ?string
    {
        return $this->photo3;
    }

    public function setPhoto3(string $photo3): self
    {
        $this->photo3 = $photo3;

        return $this;
    }

    public function getPhoto4(): ?string
    {
        return $this->photo4;
    }

    public function setPhoto4(?string $photo4): self
    {
        $this->photo4 = $photo4;

        return $this;
    }

    public function getPhoto5(): ?string
    {
        return $this->photo5;
    }

    public function setPhoto5(?string $photo5): self
    {
        $this->photo5 = $photo5;

        return $this;
    }
}
