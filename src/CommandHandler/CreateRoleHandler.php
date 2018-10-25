<?php

namespace App\CommandHandler;

use App\Command\CreateRole;
use App\Entity\Role;
use App\Repository\RoleRepository;

class CreateRoleHandler
{
    /** @var RoleRepository */
    private $roleRepository;

    public function __construct(
        RoleRepository $roleRepository
    ) {
        $this->roleRepository = $roleRepository;
    }

    public function handle(CreateRole $createRole): void
    {
        $this->roleRepository->add(
            new Role(
                $createRole->uuid,
                $createRole->name,
                $createRole->hierarchy
            )
        );
    }
}