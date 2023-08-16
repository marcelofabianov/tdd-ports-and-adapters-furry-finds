<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\ValueObjects;

use Exception;
use FurryFinds\Domain\Core\Exceptions\FurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IEmail;

final readonly class Email implements IEmail
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

    public function equals(IEmail $other): bool
    {
        return $this->getValue() === $other->getValue();
    }

    public static function validate(string $email): bool
    {
        if (filter_var(filter_var($email, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }

    /**
     * @throws Exception
     */
    public static function random(): IEmail
    {
        $random = bin2hex(random_bytes(16)).'@email.com';

        return self::create($random);
    }

    /**
     * @throws FurryDomainCoreException
     */
    public static function create(string|IEmail $value): IEmail
    {
        if ($value instanceof IEmail) {
            return $value;
        }

        if (! self::validate($value)) {
            throw FurryDomainCoreException::invalidArgument('Invalid Email!');
        }

        return new self($value);
    }
}
