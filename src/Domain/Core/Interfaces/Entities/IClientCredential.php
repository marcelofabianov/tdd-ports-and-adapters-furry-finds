<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\Interfaces\Entities;

use FurryFinds\Domain\Core\Enums\CredentialScopesEnum;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IUuid;

interface IClientCredential extends ICredential
{
    public static function create(
        IUuid $clientId,
        string $clientSecret,
        CredentialScopesEnum $scope
    ): self;
}
