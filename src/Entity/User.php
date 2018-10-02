<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }
}
