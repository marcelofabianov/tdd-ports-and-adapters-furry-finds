<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Customer\Exceptions;

use FurryFinds\Domain\Core\Exceptions\FurryDomainException;
use FurryFinds\Domain\Customer\Interfaces\Exceptions\IFurryDomainCustomerException;

final class FurryDomainCustomerException extends FurryDomainException implements IFurryDomainCustomerException
{
    public static function invalidArgument(string $message): self
    {
        return new self($message);
    }
}
