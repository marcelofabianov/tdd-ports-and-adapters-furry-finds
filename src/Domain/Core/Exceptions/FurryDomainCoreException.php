<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\Exceptions;

use FurryFinds\Domain\Core\Interfaces\Exceptions\IFurryDomainCoreException;

final class FurryDomainCoreException extends FurryDomainException implements IFurryDomainCoreException
{
    public static function invalidArgument(string $message = 'Invalid argument.', mixed $code = 422): IFurryDomainCoreException
    {
        return new self($message, $code);
    }
}
