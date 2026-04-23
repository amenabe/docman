<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::GUID, unique: true)]
    private ?string $uuid = null;

    #[ORM\Column(length: 255)]
    private ?string $fn_orig = null;

    #[ORM\Column(length: 5)]
    private ?string $fn_ext = null;

    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    private ?int $ownerid = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGuid(): ?string
    {
        return $this->uuid;
    }

    public function setGuid(string $guid): static
    {
        $this->uuid = $guid;

        return $this;
    }

    public function getFnOrig(): ?string
    {
        return $this->fn_orig;
    }

    public function setFnOrig(string $fn_orig): static
    {
        $this->fn_orig = $fn_orig;

        return $this;
    }

    public function getFnExt(): ?string
    {
        return $this->fn_ext;
    }

    public function setFnExt(string $fn_ext): static
    {
        $this->fn_ext = $fn_ext;

        return $this;
    }

    public function getOwnerid(): ?int
    {
        return $this->ownerid;
    }

    public function setOwnerid(int $ownerid): static
    {
        $this->ownerid = $ownerid;

        return $this;
    }
}
