<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MaterialRepository")
 */
class Material
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="materials")
     */
    private $category;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_delete;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $motif_delete;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Loaning", inversedBy="materials")
     */
    private $last_loaning;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getIsDelete(): ?bool
    {
        return $this->is_delete;
    }

    public function setIsDelete(bool $is_delete): self
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

    public function getLastLoaning(): ?Loaning
    {
        return $this->last_loaning;
    }

    public function setLastLoaning(?Loaning $last_loaning): self
    {
        $this->last_loaning = $last_loaning;

        return $this;
    }
}