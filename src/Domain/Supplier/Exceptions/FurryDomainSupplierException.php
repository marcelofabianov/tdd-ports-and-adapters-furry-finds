<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Supplier\Exceptions;

use FurryFinds\Domain\Core\Exceptions\FurryDomainException;
use FurryFinds\Domain\Supplier\Interfaces\Exceptions\IFurryDomainSupplierException;

final class FurryDomainSupplierException extends FurryDomainException implements IFurryDomainSupplierException
{
}
