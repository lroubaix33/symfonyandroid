<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(type="string", length=50)
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Material", mappedBy="category")
     */
    private $materials;

    private $countOfMaterials;

    public function __construct()
    {
        $this->materials = new ArrayCollection();
    }

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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getCountOfMaterials(): ?int
    {
        return $this->countOfMaterials;
    }

    public function setCountOfMaterials(int $countOfMaterials): self
    {
        $this->countOfMaterials = $countOfMaterials;

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
            $material->setCategory($this);
        }

        return $this;
    }

    public function removeMaterial(Material $material): self
    {
        if ($this->materials->contains($material)) {
            $this->materials->removeElement($material);
            // set the owning side to null (unless already changed)
            if ($material->getCategory() === $this) {
                $material->setCategory(null);
            }
        }

        return $this;
    }
}