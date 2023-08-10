<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\Exceptions;

use FurryFinds\Domain\Core\Interfaces\Exceptions\IFurryDomainException;

class FurryDomainException extends \Exception implements IFurryDomainException
{
}
