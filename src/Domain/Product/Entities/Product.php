<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Product\Entities;

use FurryFinds\Domain\Product\Interfaces\Entities\IProduct;
use JsonException;

final readonly class Product implements IProduct
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
