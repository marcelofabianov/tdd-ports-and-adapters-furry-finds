<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\Interfaces;

interface IEntity
{
    public function toArray(): array;
}
