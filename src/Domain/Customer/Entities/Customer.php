<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Customer\Entities;

use FurryFinds\Domain\Customer\Interfaces\Entities\ICustomer;
use JsonException;

final readonly class Customer implements ICustomer
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
