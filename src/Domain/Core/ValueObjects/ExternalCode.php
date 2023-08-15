<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\ValueObjects;

use Exception;
use FurryFinds\Domain\Core\Enums\ExternalCodeTypeEnum;
use FurryFinds\Domain\Core\Exceptions\FurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IExternalCode;

final readonly class ExternalCode implements IExternalCode
{
    private function __construct(
        private string|int|null $value
    ) {
    }

    public function __toString(): string
    {
        return (string) $this->getValue();
    }

    public function getValue(): string|int|null
    {
        return $this->value;
    }

    public function equals(IExternalCode $externalCode): bool
    {
        return $this->getValue() === $externalCode->getValue();
    }

    /**
     * @throws Exception
     */
    public static function random(ExternalCodeTypeEnum $type = ExternalCodeTypeEnum::integer): IExternalCode
    {
        if ($type === ExternalCodeTypeEnum::uuid) {
            return new self(Uuid::random()->getValue());
        }

        return new self(random_int(1, 1000));
    }

    public static function validate(string|int $value): bool
    {
        if (is_int($value) && $value <= 0) {
            return false;
        }

        $numericValue = (int) $value;

        if ($value === '' || $value === '0' || $numericValue === 0) {
            return false;
        }

        if ($numericValue > 0) {
            return true;
        }

        if (is_string($value) && (Uuid::validate($value) === false)) {
            return false;
        }

        return true;
    }

    public static function nullable(): null
    {
        return null;
    }

    /**
     * @throws FurryDomainCoreException
     */
    public static function create(string|int|null $value): IExternalCode
    {
        if (is_null($value)) {
            return new self(null);
        }

        if (self::validate($value) === false) {
            throw FurryDomainCoreException::invalidArgument('Invalid external code');
        }

        return new self($value);
    }
}
