<?php

declare(strict_types=1);

namespace FurryFinds\Domain\ShoppingCart\Entities;

use FurryFinds\Domain\ShoppingCart\Interfaces\Entities\IShoppingCart;
use JsonException;

final readonly class ShoppingCart implements IShoppingCart
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
