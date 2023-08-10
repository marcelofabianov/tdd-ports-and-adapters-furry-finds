<?php

declare(strict_types=1);

namespace FurryFinds\Domain\ShoppingCart\Entities;

use FurryFinds\Domain\ShoppingCart\Interfaces\Entities\IShoppingCart;
use JsonException;

final readonly class ShoppingCart implements IShoppingCart
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
