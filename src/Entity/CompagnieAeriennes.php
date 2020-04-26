<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompagnieAeriennesRepository")
 */
class CompagnieAeriennes
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
    private $nomCompagnie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vols", mappedBy="compagnie")
     */
    private $vols;

    public function __construct()
    {
        $this->vols = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCompagnie(): ?string
    {
        return $this->nomCompagnie;
    }

    public function setNomCompagnie(?string $nomCompagnie): self
    {
        $this->nomCompagnie = $nomCompagnie;

        return $this;
    }

    /**
     * @return Collection|Vols[]
     */
    public function getVols(): Collection
    {
        return $this->vols;
    }

    public function addVol(Vols $vol): self
    {
        if (!$this->vols->contains($vol)) {
            $this->vols[] = $vol;
            $vol->setCompagnie($this);
        }

        return $this;
    }

    public function removeVol(Vols $vol): self
    {
        if ($this->vols->contains($vol)) {
            $this->vols->removeElement($vol);
            // set the owning side to null (unless already changed)
            if ($vol->getCompagnie() === $this) {
                $vol->setCompagnie(null);
            }
        }

        return $this;
    }
}
