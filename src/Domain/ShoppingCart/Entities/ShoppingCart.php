<?php

declare(strict_types=1);

namespace FurryFinds\Domain\ShoppingCart\Entities;

use FurryFinds\Domain\ShoppingCart\Interfaces\Entities\IShoppingCart;

final readonly class ShoppingCart implements IShoppingCart
{
    public function toArray(): array
    {
        return [];
    }
}
