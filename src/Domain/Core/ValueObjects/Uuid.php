<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\ValueObjects;

use FurryFinds\Domain\Core\Exceptions\FurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IUuid;
use Ramsey\Uuid\Uuid as RamseyUuid;

final readonly class Uuid implements IUuid
{
    private function __construct(
        private string $value
    ) {
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(IUuid $other): bool
    {
        return $this->getValue() === $other->getValue();
    }

    public static function random(): IUuid
    {
        return new self((string) RamseyUuid::uuid4());
    }

    public static function validate(string $value): bool
    {
        if ($value === '') {
            return false;
        }

        return RamseyUuid::isValid($value);
    }

    /**
     * @throws FurryDomainCoreException
     */
    public static function create(string|IUuid $value): IUuid
    {
        if ($value instanceof IUuid) {
            return $value;
        }

        if (! self::validate($value)) {
            throw FurryDomainCoreException::invalidArgument('Invalid UUID');
        }

        return new self($value);
    }
}
