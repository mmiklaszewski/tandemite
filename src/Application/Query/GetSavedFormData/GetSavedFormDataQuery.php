<?php

namespace App\Application\Query\GetSavedFormData;

final readonly class GetSavedFormDataQuery
{
    public function __construct(
        public int $limit,
        public int $page,
    ) {
    }
}
