<?php

namespace App\Application\Query\GetSavedFormData;

use App\Domain\ReadModel\FormDataReadModel;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class GetSavedFormDataHandler
{
    public function __construct(private FormDataReadModel $formDataReadModel)
    {
    }

    public function __invoke(GetSavedFormDataQuery $query): SavedDataView
    {
        $collection = $this->formDataReadModel->findForList($query->limit, $query->page);
        $total = $this->formDataReadModel->count();

        return new SavedDataView(
            $query->limit,
            $query->page,
            $total,
            $collection,
        );
    }
}
