<?php

namespace App\Domain\Collection;

use App\Application\Query\GetSavedFormData\SavedDataView;
use App\Domain\ValueObject\SavedFormData;
use Assert\Assertion;

final class SavedFormDataCollection extends \ArrayIterator implements \JsonSerializable
{
    public function __construct(array $array = [])
    {
        Assertion::allIsInstanceOf($array, SavedFormData::class);
        parent::__construct($array);
    }

    public static function create(array $array = []): self
    {
        return new self($array);
    }

    public function append($value): void
    {
        Assertion::isInstanceOf($value, SavedFormData::class);
        parent::append($value);
    }

    public function jsonSerialize(): array
    {
        $data = [];
        /** @var SavedDataView $item */
        foreach ($this as $item) {
            $data[] = $item->jsonSerialize();
        }

        return $data;
    }
}
