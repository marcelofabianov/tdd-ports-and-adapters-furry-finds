<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\Interfaces\ValueObjects;

use FurryFinds\Domain\Core\Enums\RegistrationDocumentTypeEnum;
use FurryFinds\Domain\Core\Interfaces\IValueObject;

interface IRegistrationDocument extends IValueObject
{
    public function getValue(): self;

    public function isMatrix(): bool;

    public function prefixMatrix(): string;

    public function root(): string;

    public function digits(): string;

    public function numbers(): string;

    public function mask(): string;

    public function type(): string;

    public static function sanitize(string|int $value): string;

    public static function random(
        RegistrationDocumentTypeEnum $type = RegistrationDocumentTypeEnum::CNPJ
    ): self;

    public static function validate(string|int $value): bool;

    public static function create(string|int $value): self;
}
