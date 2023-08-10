<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\Interfaces;

interface IEntity extends \JsonSerializable
{
    public function toArray(): array;

    public function jsonSerialize(): array;

    public function __toString(): string;
}
