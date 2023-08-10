<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\Interfaces\Exceptions;

interface IFurryDomainCoreException extends IFurryDomainException
{
    public static function invalidArgument(string $message = 'Invalid argument.', mixed $code = 422): self;
}
