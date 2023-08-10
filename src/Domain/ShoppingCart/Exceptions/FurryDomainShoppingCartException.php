<?php

declare(strict_types=1);

namespace FurryFinds\Domain\ShoppingCart\Exceptions;

use FurryFinds\Domain\Core\Exceptions\FurryDomainException;
use FurryFinds\Domain\ShoppingCart\Interfaces\Exceptions\IFurryDomainShoppingCartException;

final class FurryDomainShoppingCartException extends FurryDomainException implements IFurryDomainShoppingCartException
{
}
