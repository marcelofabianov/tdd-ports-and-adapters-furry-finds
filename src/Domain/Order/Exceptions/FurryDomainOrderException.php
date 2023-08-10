<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Order\Exceptions;

use FurryFinds\Domain\Core\Exceptions\FurryDomainException;
use FurryFinds\Domain\Order\Interfaces\Exceptions\IFurryDomainOrderException;

final class FurryDomainOrderException extends FurryDomainException implements IFurryDomainOrderException
{
}
