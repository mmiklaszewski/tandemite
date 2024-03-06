<?php

namespace App\Domain\ValueObject;

final readonly class SavedFormData implements \JsonSerializable
{
    public function __construct(
        public string $name,
        public string $surname,
        public string $attachmentPath,
        public AttachmentData $attachmentData,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'surname' => $this->surname,
            'attachmentPath' => $this->attachmentPath,
            'attachmentData' => $this->attachmentData->jsonSerialize(),
        ];
    }
}
