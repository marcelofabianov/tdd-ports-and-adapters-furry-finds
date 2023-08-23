<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Customer\Interfaces\Dto;

use FurryFinds\Domain\Core\Interfaces\IDto;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\ICreatedAt;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IEmail;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IInactivatedAt;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IRegistrationDocument;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IUpdatedAt;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IUuid;

/**
 * Interface ICreateCustomerDto
 *
 * @property-read IUuid $tenantId
 * @property-read IUuid $id
 * @property-read ICreatedAt $createdAt
 * @property-read IUpdatedAt $updatedAt
 * @property-read IInactivatedAt $inactivatedAt
 * @property-read IRegistrationDocument $registrationDocument
 * @property-read string $name
 * @property-read IEmail $email
 * @property-read string $password
 */
interface ICreateCustomerDto extends IDto
{
    public function __construct(
        IUuid $tenantId,
        IUuid $id,
        ICreatedAt $createdAt,
        IUpdatedAt $updatedAt,
        IInactivatedAt $inactivatedAt,
        IRegistrationDocument $registrationDocument,
        string $name,
        IEmail $email,
        string $password,
    );
}
