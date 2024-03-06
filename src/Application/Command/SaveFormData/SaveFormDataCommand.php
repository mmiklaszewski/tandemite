<?php

namespace App\Application\Command\SaveFormData;

use App\UI\Input\FormDataInput;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final readonly class SaveFormDataCommand
{
    public function __construct(
        public string $name,
        public string $surname,
        public UploadedFile $attachment
    ) {
    }

    public static function fromInput(FormDataInput $input): self
    {
        return new self(
            $input->name,
            $input->surname,
            $input->attachment
        );
    }
}
