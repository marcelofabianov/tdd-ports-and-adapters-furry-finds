<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\Interfaces\ValueObjects;

use Carbon\CarbonInterface;
use DateTimeInterface;
use FurryFinds\Domain\Core\Interfaces\IValueObject;

interface IUpdatedAt extends IValueObject
{
    public function getValue(): DateTimeInterface;

    public function format(string $format): string;

    public function toISOString(): string;

    public function getCarbon(): CarbonInterface;

    public static function now(): self;

    public static function random(): self;

    public static function validate(string|CarbonInterface|DateTimeInterface $value): bool;

    public static function create(string|CarbonInterface|DateTimeInterface $value): self;
}
