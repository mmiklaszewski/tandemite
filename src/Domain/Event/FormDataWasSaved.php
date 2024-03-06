<?php

namespace App\Domain\Event;

use App\Domain\ValueObject\AttachmentData;
use Symfony\Component\Uid\Uuid;

final readonly class FormDataWasSaved
{
    public function __construct(
        public Uuid $uuid,
        public string $name,
        public string $surname,
        public string $attachmentPath,
        public AttachmentData $attachmentData
    ) {
    }
}
