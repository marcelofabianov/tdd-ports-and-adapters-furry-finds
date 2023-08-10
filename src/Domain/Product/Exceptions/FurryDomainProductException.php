<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Product\Exceptions;

use FurryFinds\Domain\Core\Exceptions\FurryDomainException;
use FurryFinds\Domain\Product\Interfaces\Exceptions\IFurryDomainProductException;

final class FurryDomainProductException extends FurryDomainException implements IFurryDomainProductException
{
}
