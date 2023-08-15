<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Supplier\Entities;

use FurryFinds\Domain\Supplier\Interfaces\Entities\ISupplier;
use JsonException;

final readonly class Supplier implements ISupplier
{
    /**
     * @throws JsonException
     */
    public function __toString(): string
    {
        return $this->jsonSerialize();
    }

    /**
     * @throws JsonException
     */
    public function jsonSerialize(): string
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR);
    }

    public function toArray(): array
    {
        return [];
    }
}
