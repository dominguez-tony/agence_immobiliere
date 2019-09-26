<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @UniqueEntity(
 * fields={"username"},
 * message="Nom déjà utilisé"
 * )
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
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
     * @ORM\Column(type="string", length=255,)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\EqualTo(propertyPath="confirm_password", message = "votre mot de passe doit être le même que la confirmation")
     * @Assert\Length( min = 8, max = 25, minMessage = "votre mot de passe doit faire 8 caractères minimum", maxMessage = "votre mot de passe doit faire 25 caractères maximum" )    
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message = "votre mot de passe doit être le même ")
     */
    public $confirm_password;

    public function getId(): ?int
    {
        return $this->id;
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
    public function getSalt(){}

    public function eraseCredentials(){}

    public function getRoles()
    {
            return ['ROLE_USER'];
     }
}
