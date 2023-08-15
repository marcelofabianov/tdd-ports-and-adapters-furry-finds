<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\Enums;

enum TenantContextEnum: string
{
    case PARTNER = 'partner';
    case CUSTOMER = 'customer';
}
