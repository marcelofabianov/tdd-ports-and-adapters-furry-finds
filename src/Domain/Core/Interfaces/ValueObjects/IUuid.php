<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\Interfaces\ValueObjects;

use FurryFinds\Domain\Core\Interfaces\IValueObject;

interface IUuid extends IValueObject
{
    public function equals(self $other): bool;

    public static function random(): self;

    public static function validate(string $value): bool;

    public static function create(string $value): self;
}
