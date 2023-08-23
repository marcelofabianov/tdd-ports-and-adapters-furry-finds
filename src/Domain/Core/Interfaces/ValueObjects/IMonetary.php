<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\Interfaces\ValueObjects;

use FurryFinds\Domain\Core\Interfaces\IValueObject;

interface IMonetary extends IValueObject
{
    public function format(): string;

    public function equals(self $money): bool;

    public static function random(float $min = 0.1, float $max = 10.1): self;

    public static function sanitize(float|string|int $value): float;

    public static function validate(float|string|int $value): bool;

    public static function create(float|string|int $value): self;
}
