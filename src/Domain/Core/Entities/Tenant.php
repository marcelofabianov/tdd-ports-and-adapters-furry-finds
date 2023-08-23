<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\Entities;

use Exception;
use FurryFinds\Domain\Core\Enums\TenantContextEnum;
use FurryFinds\Domain\Core\Exceptions\FurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\Entities\ITenant;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\ICreatedAt;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IInactivatedAt;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IUpdatedAt;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IUuid;
use JsonException;

final readonly class Tenant implements ITenant
{
    private function __construct(
        public IUuid $id,
        public ICreatedAt $createdAt,
        public IUpdatedAt $updatedAt,
        public IInactivatedAt $inactivatedAt,
        public TenantContextEnum $context
    ) {
    }

    /**
     * @throws JsonException
     */
    public function __toString(): string
    {
        return $this->jsonSerialize();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->getValue(),
            'created_at' => $this->createdAt->toISOString(),
            'updated_at' => $this->updatedAt->toISOString(),
            'inactivated_at' => $this->inactivatedAt->toISOString(),
            'context' => $this->context->value,
        ];
    }

    /**
     * @throws JsonException
     */
    public function jsonSerialize(): string
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR);
    }

    /**
     * @throws FurryDomainCoreException
     */
    public static function create(
        IUuid $id,
        ICreatedAt $createdAt,
        IUpdatedAt $updatedAt,
        IInactivatedAt $inactivatedAt,
        TenantContextEnum $context
    ): ITenant {
        try {
            return new self($id, $createdAt, $updatedAt, $inactivatedAt, $context);
        } catch (Exception $exception) {
            throw FurryDomainCoreException::invalidArgument($exception->getMessage());
        }
    }
}
