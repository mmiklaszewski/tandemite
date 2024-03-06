<?php

namespace App\Application\Query\GetSavedFormData;

use App\Domain\Collection\SavedFormDataCollection;

final class SavedDataView implements \JsonSerializable
{
    public function __construct(
        private int $limit,
        private int $page,
        private int $total,
        private SavedFormDataCollection $savedFormDataCollection
    )
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'limit' => $this->limit,
            'page' => $this->page,
            'total' => $this->total,
            'data' => $this->savedFormDataCollection->jsonSerialize(),
        ];;
    }
}
