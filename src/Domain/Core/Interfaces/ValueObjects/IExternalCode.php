<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\Interfaces\ValueObjects;

use FurryFinds\Domain\Core\Enums\ExternalCodeTypeEnum;
use FurryFinds\Domain\Core\Interfaces\IValueObject;

interface IExternalCode extends IValueObject
{
    public function equals(self $externalCode): bool;

    public static function random(ExternalCodeTypeEnum $type = ExternalCodeTypeEnum::integer): self;

    public static function validate(string|int $value): bool;

    public static function nullable(): null;

    public static function create(string|int $value): self;
}
