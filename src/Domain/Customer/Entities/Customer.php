<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Customer\Entities;

use FurryFinds\Domain\Core\Exceptions\FurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\Exceptions\IFurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\ICreatedAt;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IEmail;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IInactivatedAt;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IRegistrationDocument;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IUpdatedAt;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IUuid;
use FurryFinds\Domain\Customer\Interfaces\Dto\ICreateCustomerDto;
use FurryFinds\Domain\Customer\Interfaces\Entities\ICustomer;
use JsonException;

final readonly class Customer implements ICustomer
{
    private function __construct(
        private IUuid $tenantId,
        private IUuid $id,
        private ICreatedAt $createdAt,
        private IUpdatedAt $updatedAt,
        private IInactivatedAt $inactivatedAt,
        private IRegistrationDocument $registrationDocument,
        private string $name,
        private IEmail $email,
        private string $password
    ) {
    }

    /**
     * @throws JsonException
     */
    public function __toString(): string
    {
        return $this->jsonSerialize();
    }

    /**
     * @throws JsonException
     */
    public function jsonSerialize(): string
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR);
    }

    public function toArray(): array
    {
        return [
            'tenantId' => $this->tenantId,
            'id' => $this->id,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'inactivatedAt' => $this->inactivatedAt,
            'registrationDocument' => $this->registrationDocument,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

    /**
     * @throws IFurryDomainCoreException
     */
    public static function create(ICreateCustomerDto $dto): ICustomer
    {
        try {
            return new self(
                $dto->tenantId,
                $dto->id,
                $dto->createdAt,
                $dto->updatedAt,
                $dto->inactivatedAt,
                $dto->registrationDocument,
                $dto->name,
                $dto->email,
                $dto->password,
            );
        } catch (\Exception) {
            throw FurryDomainCoreException::invalidArgument('Invalid Invalid argument');
        }
    }
}
