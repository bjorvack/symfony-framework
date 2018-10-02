<?php

namespace App\Tests;

use App\Command\CreateUser;
use App\CommandHandler\CreateUserHandler;
use App\Entity\User;
use App\Repository\UserRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

class UserTest extends TestCase
{
    public function testUserCreation(): void
    {
        /** @var UserRepository $userRepository */
        $userRepository = $this->createMock(UserRepository::class);
        $userRepository->expects($this->once())
            ->method('add')
            ->will($this->returnCallback(function ($user) {
                $this->assertInstanceOf(User::class, $user);
                if ($user instanceof User) {
                    $this->assertInstanceOf(UuidInterface::class, $user->getUuid());
                    $this->assertEquals('test@email.com', $user->getEmail());
                    $this->assertNotEquals('plainPassword', $user->getPassword());
                    $this->assertInternalType('array', $user->getRoles());
                    $this->assertArraySubset(['ROLE_USER'], $user->getRoles());
                }
            }));

        $handler = new CreateUserHandler(
            $userRepository,
            new BCryptPasswordEncoder(10)
        );

        $handler->handle(
            new CreateUser(
                'test@email.com',
                'plainPassword'
            )
        );
    }
}
