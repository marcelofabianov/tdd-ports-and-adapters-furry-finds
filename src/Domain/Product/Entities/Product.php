<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Product\Entities;

use FurryFinds\Domain\Product\Interfaces\Entities\IProduct;

final readonly class Product implements IProduct
{
    public function toArray(): array
    {
        return [];
    }
}
