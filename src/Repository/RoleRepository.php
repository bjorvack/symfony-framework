<?php

namespace App\Repository;

use App\Entity\Role;

interface RoleRepository
{
    public function add(Role $role): void;
}