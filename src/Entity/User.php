<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
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
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Role")
     * @ORM\JoinTable(
     *     name="user_roles",
     *     joinColumns={@ORM\JoinColumn(name="user_uuid", referencedColumnName="uuid")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_uuid", referencedColumnName="uuid")}
     * )
     */
    private $roles;

    public function __construct(UuidInterface $uuid, string $email, string $password, Collection $roles)
    {
        $this->uuid = $uuid;
        $this->email = $email;
        $this->password = $password;
        $this->roles = $roles;
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

    public function getRoles(): Collection
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
