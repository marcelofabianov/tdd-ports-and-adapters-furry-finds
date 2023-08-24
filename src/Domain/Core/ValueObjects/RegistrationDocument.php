<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\ValueObjects;

use FurryFinds\Domain\Core\Enums\RegistrationDocumentTypeEnum;
use FurryFinds\Domain\Core\Exceptions\FurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\Exceptions\IFurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IRegistrationDocument;

final class RegistrationDocument implements IRegistrationDocument
{
    private function __construct(
        private IRegistrationDocument $value
    ) {
    }

    public function __toString(): string
    {
        return $this->value->numbers();
    }

    public function jsonSerialize(): array
    {
        return $this->value->jsonSerialize();
    }

    public function getValue(): IRegistrationDocument
    {
        return $this->value;
    }

    public function isMatrix(): bool
    {
        return $this->value->isMatrix();
    }

    public function prefixMatrix(): string
    {
        return $this->value->prefixMatrix();
    }

    public function root(): string
    {
        return $this->value->root();
    }

    public function digits(): string
    {
        return $this->value->digits();
    }

    public function numbers(): string
    {
        return $this->value->numbers();
    }

    public function mask(): string
    {
        return $this->value->mask();
    }

    public function type(): string
    {
        return $this->value->type();
    }

    public static function sanitize(string|int $value): string
    {
        if (is_int($value)) {
            $value = (string) $value;
        }

        return preg_replace(pattern: '/[^0-9]/', replacement: '', subject: $value);
    }

    public static function random(RegistrationDocumentTypeEnum $type = RegistrationDocumentTypeEnum::CPF): IRegistrationDocument
    {
        if (RegistrationDocumentTypeEnum::CNPJ) {
            return self::create(Cnpj::random()->numbers());
        }

        return self::create(Cpf::random()->numbers());
    }

    public static function validate(int|string $value): bool
    {
        if (Cnpj::validate($value)) {
            return true;
        }

        if (Cpf::validate($value)) {
            return true;
        }

        return false;
    }

    /**
     * @throws IFurryDomainCoreException
     */
    public static function create(int|string $value): IRegistrationDocument
    {
        if (Cnpj::validate($value)) {
            return new self(Cnpj::create($value));
        }

        if (Cpf::validate($value)) {
            return new self(Cpf::create($value));
        }

        throw FurryDomainCoreException::invalidArgument('Invalid registration document');
    }
}
