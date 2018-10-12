<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LoaningRepository")
 */
class Loaning
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_back;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_loaning;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $note;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Material", mappedBy="last_loaning")
     */
    private $materials;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="loanings")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Material1", inversedBy="loanings")
     */
    private $material;

    public function __construct()
    {
        $this->materials = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateBack(): ?\DateTimeInterface
    {
        return $this->date_back;
    }

    public function setDateBack(\DateTimeInterface $date_back): self
    {
        $this->date_back = $date_back;

        return $this;
    }

    public function getDateLoaning(): ?\DateTimeInterface
    {
        return $this->date_loaning;
    }

    public function setDateLoaning(\DateTimeInterface $date_loaning): self
    {
        $this->date_loaning = $date_loaning;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return Collection|Material[]
     */
    public function getMaterials(): Collection
    {
        return $this->materials;
    }

    public function addMaterial(Material $material): self
    {
        if (!$this->materials->contains($material)) {
            $this->materials[] = $material;
            $material->setLastLoaning($this);
        }

        return $this;
    }

    public function removeMaterial(Material $material): self
    {
        if ($this->materials->contains($material)) {
            $this->materials->removeElement($material);
            // set the owning side to null (unless already changed)
            if ($material->getLastLoaning() === $this) {
                $material->setLastLoaning(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getMaterial(): ?Material1
    {
        return $this->material;
    }

    public function setMaterial(?Material1 $material): self
    {
        $this->material = $material;

        return $this;
    }
}