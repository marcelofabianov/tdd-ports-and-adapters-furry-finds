<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\Interfaces\ValueObjects;

use Carbon\CarbonInterface;
use DateTimeInterface;
use FurryFinds\Domain\Core\Interfaces\IValueObject;

interface IInactivatedAt extends IValueObject
{
    public function getValue(): DateTimeInterface|null;

    public function format(string $format = 'Y-m-d H:i:s'): string|null;

    public function toISOString(): string|null;

    public function getCarbon(): CarbonInterface|null;

    public static function now(): self;

    public static function random(): self;

    public function isNull(): bool;

    public static function nullable(): null;

    public static function validate(string|CarbonInterface|DateTimeInterface $value): bool;

    public static function create(string|CarbonInterface|DateTimeInterface|null $value): self;
}
