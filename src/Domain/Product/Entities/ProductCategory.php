<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Product\Entities;

use FurryFinds\Domain\Product\Interfaces\Entities\IProductCategory;
use JsonException;

final readonly class ProductCategory implements IProductCategory
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
