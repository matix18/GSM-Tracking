<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VolsRepository")
 */
class Vols
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDepart;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heureDepart;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateArrivee;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heureArrivee;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompagnieAeriennes", inversedBy="vols")
     */
    private $compagnie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $aeroportDepart;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $aeroportArrivee;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservations", mappedBy="vol")
     */
    private $reservations;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(?\DateTimeInterface $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getHeureDepart(): ?\DateTimeInterface
    {
        return $this->heureDepart;
    }

    public function setHeureDepart(?\DateTimeInterface $heureDepart): self
    {
        $this->heureDepart = $heureDepart;

        return $this;
    }

    public function getDateArrivee(): ?\DateTimeInterface
    {
        return $this->dateArrivee;
    }

    public function setDateArrivee(?\DateTimeInterface $dateArrivee): self
    {
        $this->dateArrivee = $dateArrivee;

        return $this;
    }

    public function getHeureArrivee(): ?\DateTimeInterface
    {
        return $this->heureArrivee;
    }

    public function setHeureArrivee(?\DateTimeInterface $heureArrivee): self
    {
        $this->heureArrivee = $heureArrivee;

        return $this;
    }

    public function getCompagnie(): ?CompagnieAeriennes
    {
        return $this->compagnie;
    }

    public function setCompagnie(?CompagnieAeriennes $compagnie): self
    {
        $this->compagnie = $compagnie;

        return $this;
    }

    public function getAeroportDepart(): ?string
    {
        return $this->aeroportDepart;
    }

    public function setAeroportDepart(?string $aeroportDepart): self
    {
        $this->aeroportDepart = $aeroportDepart;

        return $this;
    }

    public function getAeroportArrivee(): ?string
    {
        return $this->aeroportArrivee;
    }

    public function setAeroportArrivee(?string $aeroportArrivee): self
    {
        $this->aeroportArrivee = $aeroportArrivee;

        return $this;
    }

    /**
     * @return Collection|Reservations[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservations $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setVol($this);
        }

        return $this;
    }

    public function removeReservation(Reservations $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getVol() === $this) {
                $reservation->setVol(null);
            }
        }

        return $this;
    }
}
