<?php

namespace App\Domain\ReadModel;

use App\Domain\Collection\SavedFormDataCollection;

interface FormDataReadModel
{
    public function findForList(int $limit = 10, int $page = 1): SavedFormDataCollection;

    public function count(): int;
}
