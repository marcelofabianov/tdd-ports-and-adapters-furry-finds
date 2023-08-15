<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\Interfaces\Entities;

use FurryFinds\Domain\Core\Enums\TenantContextEnum;
use FurryFinds\Domain\Core\Interfaces\IEntity;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\ICreatedAt;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IInactivatedAt;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IUpdatedAt;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IUuid;

/**
 * Interface ITenant
 *
 * @property-read IUuid $id
 * @property-read ICreatedAt $createdAt
 * @property-read IUpdatedAt $updatedAt
 * @property-read IInactivatedAt $inactivatedAt
 * @property-read TenantContextEnum $context
 */
interface ITenant extends IEntity
{
    public static function create(
        IUuid $id,
        ICreatedAt $createdAt,
        IUpdatedAt $updatedAt,
        IInactivatedAt $inactivatedAt,
        TenantContextEnum $context
    ): self;
}
