<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Order\Entities;

use FurryFinds\Domain\Order\Interfaces\Entities\IOrderItem;

final readonly class OrderItem implements IOrderItem
{
    public function toArray(): array
    {
        return [];
    }
}
