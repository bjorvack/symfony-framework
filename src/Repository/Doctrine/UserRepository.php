<?php

namespace App\Repository\Doctrine;

use App\Entity\User;
use App\Repository\UserRepository as UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ramsey\Uuid\UuidInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findOneByUuid(UuidInterface $uuid): ?User
    {
        return $this->find($uuid);
    }

    public function findOneByEmail(string $email): ?User
    {
        return $this->findOneBy(['email' => $email]);
    }

    public function add(User $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush($user);
    }
}
