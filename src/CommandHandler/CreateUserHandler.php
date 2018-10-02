<?php

namespace App\CommandHandler;

use App\Command\CreateUser;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

class CreateUserHandler
{
    /** @var UserRepository */
    private $userRepository;

    /** @var BCryptPasswordEncoder */
    private $passwordEncoder;

    public function __construct(
        UserRepository $userRepository,
        BCryptPasswordEncoder $passwordEncoder
    ) {
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function handle(CreateUser $createUser): void
    {
        $this->userRepository->add(
            new User(
                $createUser->uuid,
                $createUser->email,
                $this->passwordEncoder->encodePassword(
                    $createUser->plainPassword,
                    null // The salt get's ignored for BCrypt
                ),
                $createUser->roles
            )
        );
    }
}