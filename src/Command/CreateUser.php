<?php

namespace App\Command;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class CreateUser
{
    /**
     * @var UuidInterface
     *
     * @Assert\NotBlank()
     */
    public $uuid;

    /**
     * @var string
     *
     * @Assert\Email()
     */
    public $email;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min="8",
     *     minMessage="user.password.minLength"
     * )
     */
    public $plainPassword;

    /**
     * @var array
     *
     * @Assert\Count(
     *     min="1",
     *     minMessage=""user.roles.minCount"
     * )
     */
    public $roles;

    public function __construct(string $email, string $plainPassword, array $roles = [])
    {
        $this->uuid = Uuid::uuid4();
        $this->email = $email;
        $this->plainPassword = $plainPassword;
        $this->roles = $roles;
    }
}