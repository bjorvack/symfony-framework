<?php

namespace App\Repository;

use App\Entity\User;
use Ramsey\Uuid\UuidInterface;

interface UserRepository
{
    public function findOneByUuid(UuidInterface $uuid): ?User;

    public function findOneByEmail(string $email): ?User;

    public function add(User $user): void;
}
