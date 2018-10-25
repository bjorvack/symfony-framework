<?php

namespace App\Command;

use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CreateRole
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
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/^ROLE_[A-Z]{1,}/")
     */
    public $name;

    /**
     * @var Collection
     */
    public $hierarchy;

    public function __construct(string $name, Collection $hierarchy)
    {
        $this->uuid = Uuid::uuid4();
        $this->name = $name;
        $this->hierarchy = $hierarchy;
    }
}