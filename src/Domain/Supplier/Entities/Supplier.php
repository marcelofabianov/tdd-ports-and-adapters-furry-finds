<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Supplier\Entities;

use FurryFinds\Domain\Supplier\Interfaces\Entities\ISupplier;
use JsonException;

final readonly class Supplier implements ISupplier
{
    public function toArray(): array
    {
        return [];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * @throws JsonException
     */
    public function __toString(): string
    {
        return json_encode($this, JSON_THROW_ON_ERROR);
    }
}
