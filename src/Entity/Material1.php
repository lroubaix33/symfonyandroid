<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Material1Repository")
 */
class Material1
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $libelle;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_delete;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $motif_delete;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Loaning", mappedBy="material")
     */
    private $loanings;

    public function __construct()
    {
        $this->loanings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getIsDelete(): ?bool
    {
        return $this->is_delete;
    }

    public function setIsDelete(?bool $is_delete): self
    {
        $this->is_delete = $is_delete;

        return $this;
    }

    public function getMotifDelete(): ?string
    {
        return $this->motif_delete;
    }

    public function setMotifDelete(?string $motif_delete): self
    {
        $this->motif_delete = $motif_delete;

        return $this;
    }

    /**
     * @return Collection|Loaning[]
     */
    public function getLoanings(): Collection
    {
        return $this->loanings;
    }

    public function addLoaning(Loaning $loaning): self
    {
        if (!$this->loanings->contains($loaning)) {
            $this->loanings[] = $loaning;
            $loaning->setMaterial($this);
        }

        return $this;
    }

    public function removeLoaning(Loaning $loaning): self
    {
        if ($this->loanings->contains($loaning)) {
            $this->loanings->removeElement($loaning);
            // set the owning side to null (unless already changed)
            if ($loaning->getMaterial() === $this) {
                $loaning->setMaterial(null);
            }
        }

        return $this;
    }
}
