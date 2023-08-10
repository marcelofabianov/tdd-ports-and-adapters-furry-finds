<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Order\Entities;

use FurryFinds\Domain\Order\Interfaces\Entities\IOrder;

final readonly class Order implements IOrder
{
    public function toArray(): array
    {
        return [];
    }
}
