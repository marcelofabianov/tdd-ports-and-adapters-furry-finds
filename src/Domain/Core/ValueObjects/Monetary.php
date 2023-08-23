<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\ValueObjects;

use Exception;
use FurryFinds\Domain\Core\Exceptions\FurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\Exceptions\IFurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IMonetary;

final readonly class Monetary implements IMonetary
{
    private function __construct(
        private float $value
    ) {
    }

    public function format(): string
    {
        return number_format($this->value, 2, ',', '.');
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }

    public function equals(IMonetary $money): bool
    {
        return $this->value === $money->getValue();
    }

    public static function random(float $min = 0.1, float $max = 10.1): IMonetary
    {
        return new self($min + mt_rand() / mt_getrandmax() * ($max - $min));
    }

    /**
     * @throws IFurryDomainCoreException
     */
    public static function sanitize(float|string|int $value): float
    {
        if (is_float($value) || is_int($value)) {
            return (float) $value;
        }

        if (self::validateSpecialCases($value) === true) {
            return 0.00;
        }

        $value = str_replace(' ', '', $value);

        if (str_contains($value, '.') && ! str_contains($value, ',')) {
            return (float) $value;
        }
        if (! str_contains($value, '.') && str_contains($value, ',')) {
            return (float) str_replace(',', '.', $value);
        }
        if (str_contains($value, '.') && str_contains($value, ',')) {
            $value = str_replace('.', '', $value);

            return (float) str_replace(',', '.', $value);
        }

        throw FurryDomainCoreException::invalidArgument();
    }

    private static function validateSpecialCases(string $value): bool
    {
        return $value === '0.00' ||
            $value === '0.0' ||
            $value === '0' ||
            $value === '.0' ||
            $value === '.00' ||
            $value === '.000';
    }

    private static function validateWithDot(string $value): bool
    {
        if (str_contains($value, '.') && ! str_contains($value, ',')) {
            // Verificar se há pelo menos um dígito antes do ponto
            if (! preg_match('/^\d+\./', $value)) {
                return false;
            }
            // Verificar se há pelo menos dois dígitos depois do ponto
            if (! preg_match('/^\d+(\.\d{2})?$/', $value)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Verifica se existe virgula e se existe somente dois digitos depois da virgula e no mínimo 1 digito antes da virgula
     */
    private static function validateWithComma(string $value): bool
    {
        if (str_contains($value, ',')) {
            $value = str_replace('.', '', $value);

            if (! preg_match('/^\d+?,\d{2}$/', $value)) {
                return false;
            }
        }

        return true;
    }

    private static function validateValueString(string $value): bool
    {
        // Remover espaços em branco
        $value = str_replace(' ', '', $value);

        // Verifica se alem de ponto, virgula e 0-9, há outros caracteres
        if (! preg_match('/^[\d,.]+$/', $value)) {
            return false;
        }

        // condicoes de zero suportadas
        if (self::validateSpecialCases($value) === true) {
            return true;
        }

        // quando tiver virgula na string
        if (self::validateWithComma($value) === false) {
            return false;
        }

        // quando nao tiver virgula e tiver ponto
        if (self::validateWithDot($value) === false) {
            return false;
        }

        return true;
    }

    public static function validate(float|string|int $value): bool
    {
        if (is_int($value) || is_float($value)) {
            return true;
        }

        if (self::validateValueString($value) === false) {
            return false;
        }

        return true;
    }

    /**
     * @throws IFurryDomainCoreException
     */
    public static function create(float|string|int $value): IMonetary
    {
        if (self::validate($value) === false) {
            throw FurryDomainCoreException::invalidArgument();
        }

        try {
            return new self(self::sanitize($value));
        } catch (Exception) {
            throw FurryDomainCoreException::invalidArgument();
        }
    }
}
