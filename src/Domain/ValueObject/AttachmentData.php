<?php

namespace App\Domain\ValueObject;

use Assert\Assertion;

final readonly class AttachmentData implements \JsonSerializable
{
    public function __construct(
        public string $originalName,
        public string $extension,
        public string $mimeType
    ) {
    }

    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'originalName');
        Assertion::string($data['originalName']);

        Assertion::keyExists($data, 'extension');
        Assertion::string($data['extension']);

        Assertion::keyExists($data, 'mimeType');
        Assertion::string($data['mimeType']);

        return new self(
            $data['originalName'],
            $data['extension'],
            $data['mimeType'],
        );
    }

    public function jsonSerialize(): array
    {
        return [
            'originalName' => $this->originalName,
            'extension' => $this->extension,
            'mimeType' => $this->mimeType,
        ];
    }
}
