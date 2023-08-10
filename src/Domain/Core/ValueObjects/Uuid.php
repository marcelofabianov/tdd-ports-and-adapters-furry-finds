<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\ValueObjects;

use FurryFinds\Domain\Core\Interfaces\ValueObjects\IUuid;

final readonly class Uuid implements IUuid
{
    private function __construct(
        private string $value
    ) {
    }

    public function __toString(): string
    {
        return '';
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
