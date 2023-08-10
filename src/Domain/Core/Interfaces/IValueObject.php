<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\Interfaces;

interface IValueObject
{
    public function __toString(): string;

    public function getValue(): mixed;
}
