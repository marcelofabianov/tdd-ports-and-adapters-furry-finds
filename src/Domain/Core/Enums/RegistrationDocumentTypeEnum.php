<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\Enums;

enum RegistrationDocumentTypeEnum: string
{
    case CPF = 'CPF';
    case CNPJ = 'CNPJ';
}
