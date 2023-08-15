<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Order\Entities;

use FurryFinds\Domain\Order\Interfaces\Entities\IOrder;
use JsonException;

final readonly class Order implements IOrder
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
