<?php

namespace App\Infrastructure\Entity;

use App\Infrastructure\Doctrine\Type\UuidType;
use App\Infrastructure\Repository\FormDataRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: FormDataRepository::class)]
final class FormData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: UuidType::NAME)]
    private ?Uuid $uuid = null;

    #[ORM\Column(type: 'text')]
    private string $name;

    #[ORM\Column(type: 'text')]
    private string $surname;

    #[ORM\Column(type: 'text')]
    private string $attachmentPath;

    #[ORM\Column(type: 'json')]
    private array $attachmentData;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getUuid(): ?Uuid
    {
        return $this->uuid;
    }

    public function setUuid(?Uuid $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getAttachmentPath(): string
    {
        return $this->attachmentPath;
    }

    public function setAttachmentPath(string $attachmentPath): void
    {
        $this->attachmentPath = $attachmentPath;
    }

    public function getAttachmentData(): array
    {
        return $this->attachmentData;
    }

    public function setAttachmentData(array $attachmentData): void
    {
        $this->attachmentData = $attachmentData;
    }
}
