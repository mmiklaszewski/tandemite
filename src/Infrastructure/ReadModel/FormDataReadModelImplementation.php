<?php

namespace App\Infrastructure\ReadModel;

use App\Domain\Collection\SavedFormDataCollection;
use App\Domain\ReadModel\FormDataReadModel;
use App\Domain\ValueObject\AttachmentData;
use App\Domain\ValueObject\SavedFormData;
use App\Infrastructure\Entity\FormData;
use App\Infrastructure\Repository\FormDataRepository;

final readonly class FormDataReadModelImplementation implements FormDataReadModel
{
    public function __construct(private FormDataRepository $formDataRepository)
    {
    }

    public function findForList(int $limit = 10, int $page = 1): SavedFormDataCollection
    {
        $qb = $this->formDataRepository->createQueryBuilder('f');
        $qb
            ->setMaxResults($limit)
            ->setFirstResult(($page - 1) * $limit);

        $entities = $qb->getQuery()->getResult();

        $collection = SavedFormDataCollection::create();
        /** @var FormData $entity */
        foreach ($entities as $entity) {
            $collection->append(
                new SavedFormData(
                    $entity->getName(),
                    $entity->getSurname(),
                    $entity->getAttachmentPath(),
                    AttachmentData::fromArray($entity->getAttachmentData())
                )
            );
        }

        return $collection;
    }

    public function count(): int
    {
        return $this->formDataRepository->count();
    }
}
