<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *  fields = {"email"},
 *  message = "L'email que vous avez rentré est déjà dans la base de donnée."
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit faire minimum 8 caractères.")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $register_at;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Vous n'avez pas tapé le même mot de passe.")
     */
    public $confirm_password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Loaning", mappedBy="user")
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRegisterAt(): ?\DateTimeInterface
    {
        return $this->register_at;
    }

    public function setRegisterAt(?\DateTimeInterface $register_at): self
    {
        $this->register_at = $register_at;

        return $this;
    }

    public function eraseCredentials() {}

    public function getSalt() {}

    public function getRoles() {
        return ['ROLE_USER'];
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
            $loaning->setUser($this);
        }

        return $this;
    }

    public function removeLoaning(Loaning $loaning): self
    {
        if ($this->loanings->contains($loaning)) {
            $this->loanings->removeElement($loaning);
            // set the owning side to null (unless already changed)
            if ($loaning->getUser() === $this) {
                $loaning->setUser(null);
            }
        }

        return $this;
    }
}
