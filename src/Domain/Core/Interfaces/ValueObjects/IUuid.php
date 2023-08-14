<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\Interfaces\ValueObjects;

use FurryFinds\Domain\Core\Interfaces\IValueObject;

interface IUuid extends IValueObject
{
    public function equals(IUuid $other): bool;

    public static function random(): IUuid;

    public static function validate(string $value): bool;

    public static function create(string $value): IUuid;
}
