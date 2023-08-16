<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\Enums;

enum CredentialScopesEnum: string
{
    case CUSTOMERS_WRITE = 'customers-write';
    case CUSTOMERS_READ = 'customers-read';
    case CUSTOMERS = 'customers';
    case PARTNERS_WRITE = 'partners-write';
    case PARTNERS_READ = 'partners-read';
    case PARTNERS = 'partners';
}
