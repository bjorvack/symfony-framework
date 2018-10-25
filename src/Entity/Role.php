<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */
class Role
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
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Role")
     * @ORM\JoinTable(
     *     name="role_hierarchy",
     *     joinColumns={@ORM\JoinColumn(name="parent_uuid", referencedColumnName="uuid")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="child_uuid", referencedColumnName="uuid")}
     * )
     */
    private $hierarchy;

    /**
     * Role constructor.
     * @param UuidInterface $uuid
     * @param string $name
     * @param Collection $hierarchy
     */
    public function __construct(UuidInterface $uuid, string $name, ?Collection $hierarchy = null)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->hierarchy = $hierarchy;

        if (empty($hierarchy)) {
            $this->hierarchy = new ArrayCollection();
        }
    }

    /**
     * @return UuidInterface
     */
    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Collection
     */
    public function getHierarchy(): Collection
    {
        return $this->hierarchy;
    }
}