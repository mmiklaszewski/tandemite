<?php

namespace App\UI\Input;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class FormDataInput
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 1, max: 100)]
        public string $name,

        #[Assert\NotBlank]
        #[Assert\Length(min: 1, max: 100)]
        public string $surname,

        #[Assert\File(
            maxSize: '1024k',
            mimeTypes: ['image/*'],
        )]
        public UploadedFile $attachment,
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->get('name', ''),
            $request->get('surname', ''),
            $request->files->get('attachment')
        );
    }
}
