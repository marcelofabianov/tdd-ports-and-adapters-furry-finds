<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\Entities;

use Exception;
use FurryFinds\Domain\Core\Enums\CredentialGrantTypeEnum;
use FurryFinds\Domain\Core\Enums\CredentialScopesEnum;
use FurryFinds\Domain\Core\Exceptions\FurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\Entities\IClientCredential;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IUuid;
use JsonException;

final readonly class ClientCredential implements IClientCredential
{
    private CredentialGrantTypeEnum $grantType;

    private function __construct(
        private IUuid $clientId,
        private string $clientSecret,
        private CredentialScopesEnum $scope
    ) {
        $this->grantType = CredentialGrantTypeEnum::CLIENT_CREDENTIALS;
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
            'grant_type' => $this->grantType->value,
            'client_id' => $this->clientId->getValue(),
            'client_secret' => $this->clientSecret,
            'scope' => $this->scope->value,
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
        IUuid $clientId,
        string $clientSecret,
        CredentialScopesEnum $scope
    ): IClientCredential {
        try {
            return new self($clientId, $clientSecret, $scope);
        } catch (Exception $exception) {
            throw FurryDomainCoreException::invalidArgument($exception->getMessage());
        }
    }
}
