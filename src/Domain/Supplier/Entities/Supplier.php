<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Supplier\Entities;

use FurryFinds\Domain\Supplier\Interfaces\Entities\ISupplier;

final readonly class Supplier implements ISupplier
{
    public function toArray(): array
    {
        return [];
    }
}
