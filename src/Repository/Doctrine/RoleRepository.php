<?php

namespace App\Repository\Doctrine;

use App\Entity\Role;
use App\Repository\RoleRepository as RoleRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class RoleRepository extends ServiceEntityRepository implements RoleRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Role::class);
    }

    public function add(Role $role): void
    {
        $this->getEntityManager()->persist($role);
        $this->getEntityManager()->flush($role);
    }

    public function findOneByName(string $name): Role
    {
        return $this->createQueryBuilder('r')
            ->where('r.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getSingleResult();
    }
}
