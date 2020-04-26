<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientsRepository")
 */
class Clients
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
    private $nomcli;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenomcli;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telcli;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emailcli;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservations", mappedBy="client")
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

    public function getNomcli(): ?string
    {
        return $this->nomcli;
    }

    public function setNomcli(?string $nomcli): self
    {
        $this->nomcli = $nomcli;

        return $this;
    }

    public function getPrenomcli(): ?string
    {
        return $this->prenomcli;
    }

    public function setPrenomcli(?string $prenomcli): self
    {
        $this->prenomcli = $prenomcli;

        return $this;
    }

    public function getTelcli(): ?string
    {
        return $this->telcli;
    }

    public function setTelcli(?string $telcli): self
    {
        $this->telcli = $telcli;

        return $this;
    }

    public function getEmailcli(): ?string
    {
        return $this->emailcli;
    }

    public function setEmailcli(?string $emailcli): self
    {
        $this->emailcli = $emailcli;

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
            $reservation->setClient($this);
        }

        return $this;
    }

    public function removeReservation(Reservations $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getClient() === $this) {
                $reservation->setClient(null);
            }
        }

        return $this;
    }
}
