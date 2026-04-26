<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    private ?int $id = null;

    #[ORM\Column(length: 5)]
    private ?string $file_ext = null;

    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    private ?int $owner_id = null;

    #[ORM\Column(type: 'blob', nullable: true)]
    private $file = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getFileExt(): ?string
    {
        return $this->file_ext;
    }

    public function setFileExt(string $file_ext): self
    {
        $this->file_ext = $file_ext;

        return $this;
    }


    public function getOwnerId(): ?int
    {
        return $this->owner_id;
    }

    public function setOwnerId(int $owner_id): self
    {
        $this->owner_id = $owner_id;

        return $this;
    }


    public function getFileData()
    {
        return $this->file;
    }

    public function setFileData($file_data): self
    {
        $this->file = $file_data;

        return $this;
    }
}
