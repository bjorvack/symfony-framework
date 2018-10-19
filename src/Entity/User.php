<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Serializable;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Doctrine\UserRepository")
 */
class User implements UserInterface, Serializable
{
    /**
     * @var UuidInterface
     *
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="uuid")
     */
    private $uuid;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=190)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=60)
     */
    private $password;

    /**
     * @var array
     *
     * @ORM\Column(type="simple_array")
     */
    private $roles = [];

    public function __construct(UuidInterface $uuid, string $email, string $password, ?array $roles)
    {
        $this->uuid = $uuid;
        $this->email = $email;
        $this->password = $password;
        $this->roles = $roles;

        if (empty($roles)) {
            $this->roles = ['ROLE_USER'];
        }
    }

    public function getUuid(): ?UuidInterface
    {
        return $this->uuid;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function getUsername(): string
    {
        return $this->getEmail();
    }

    public function eraseCredentials()
    {
    }

    public function serialize()
    {
        return serialize(array(
            $this->uuid,
            $this->email,
            $this->password,
            $this->roles
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->uuid,
            $this->email,
            $this->password,
            $this->roles
            ) = unserialize($serialized);
    }
}
