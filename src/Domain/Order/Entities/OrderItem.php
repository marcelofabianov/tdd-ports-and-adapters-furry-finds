<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Order\Entities;

use FurryFinds\Domain\Order\Interfaces\Entities\IOrderItem;
use JsonException;

final readonly class OrderItem implements IOrderItem
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
