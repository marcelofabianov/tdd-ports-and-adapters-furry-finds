<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Customer\Dto;

use FurryFinds\Domain\Core\Interfaces\ValueObjects\ICreatedAt;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IEmail;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IInactivatedAt;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IRegistrationDocument;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IUpdatedAt;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IUuid;
use FurryFinds\Domain\Customer\Interfaces\Dto\ICreateCustomerDto;

final readonly class CreateCustomerDto implements ICreateCustomerDto
{
    public function __construct(
        public IUuid $tenantId,
        public IUuid $id,
        public ICreatedAt $createdAt,
        public IUpdatedAt $updatedAt,
        public IInactivatedAt $inactivatedAt,
        public IRegistrationDocument $registrationDocument,
        public string $name,
        public IEmail $email,
        public string $password,
    ) {
    }
}
