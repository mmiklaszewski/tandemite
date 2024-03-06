<?php

namespace App\Infrastructure\Projection;

use App\Domain\Event\FormDataWasSaved;
use App\Infrastructure\Entity\FormData;
use App\Infrastructure\Repository\FormDataRepository;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: FormDataWasSaved::class, method: 'projectWhenFormDataWasSaved')]
final readonly class FormDataProjection
{
    public function __construct(private FormDataRepository $formDataRepository)
    {
    }

    public function projectWhenFormDataWasSaved(FormDataWasSaved $event): void
    {
        $entity = new FormData();
        $entity->setUuid($event->uuid);
        $entity->setName($event->name);
        $entity->setSurname($event->surname);
        $entity->setAttachmentPath($event->attachmentPath);
        $entity->setAttachmentData($event->attachmentData->jsonSerialize());

        $this->formDataRepository->save($entity);
    }
}
