<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BagagesRepository")
 */
class Bagages
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codeBagage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $poids;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $listeBagages;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Reservations", inversedBy="bagages")
     */
    private $reservation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeBagage(): ?string
    {
        return $this->codeBagage;
    }

    public function setCodeBagage(?string $codeBagage): self
    {
        $this->codeBagage = $codeBagage;

        return $this;
    }

    public function getPoids(): ?string
    {
        return $this->poids;
    }

    public function setPoids(?string $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getListeBagages(): ?string
    {
        return $this->listeBagages;
    }

    public function setListeBagages(?string $listeBagages): self
    {
        $this->listeBagages = $listeBagages;

        return $this;
    }

    public function getReservation(): ?Reservations
    {
        return $this->reservation;
    }

    public function setReservation(?Reservations $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }
}
