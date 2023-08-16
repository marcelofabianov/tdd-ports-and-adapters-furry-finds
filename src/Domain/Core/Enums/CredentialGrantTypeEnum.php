<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\Enums;

enum CredentialGrantTypeEnum: string
{
    case CLIENT_CREDENTIALS = 'client_credentials';
    case PASSWORD = 'password';
}
