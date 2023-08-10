<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Product\Entities;

use FurryFinds\Domain\Product\Interfaces\Entities\IProductCategory;

final readonly class ProductCategory implements IProductCategory
{
    public function toArray(): array
    {
        return [];
    }
}
