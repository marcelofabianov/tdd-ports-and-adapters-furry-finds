<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\Enums;

enum ExternalCodeTypeEnum: string
{
    case integer = 'integer';
    case uuid = 'uuid';
}
