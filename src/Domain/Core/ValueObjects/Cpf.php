<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\ValueObjects;

use FurryFinds\Domain\Core\Enums\RegistrationDocumentTypeEnum;
use FurryFinds\Domain\Core\Exceptions\FurryDomainCoreException;
use FurryFinds\Domain\Core\Helpers\ApplyMask;
use FurryFinds\Domain\Core\Interfaces\Exceptions\IFurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\ICpf;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IRegistrationDocument;

final readonly class Cpf implements ICpf
{
    private function __construct(
        private string $value
    ) {
    }

    public function __toString(): string
    {
        return $this->numbers();
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => $this->type(),
            'value' => $this->numbers(),
            'mask' => $this->mask(),
        ];
    }

    public function getValue(): ICpf
    {
        return $this;
    }

    public function isMatrix(): bool
    {
        return true;
    }

    public function prefixMatrix(): string
    {
        return $this->numbers();
    }

    public function root(): string
    {
        return substr($this->numbers(), 0, 9);
    }

    public function digits(): string
    {
        return substr($this->numbers(), -2);
    }

    public function numbers(): string
    {
        return self::sanitize($this->value);
    }

    public function mask(): string
    {
        return ApplyMask::custom($this->value, '###.###.###-##');
    }

    public function type(): string
    {
        return RegistrationDocumentTypeEnum::CPF->value;
    }

    public static function sanitize(string|int $value): string
    {
        if (is_int($value)) {
            $value = (string) $value;
        }

        return preg_replace('/[^0-9]/', '', $value);
    }

    public static function random(
        RegistrationDocumentTypeEnum $type = RegistrationDocumentTypeEnum::CPF
    ): IRegistrationDocument {
        $n1 = random_int(0, 9);
        $n2 = random_int(0, 9);
        $n3 = random_int(0, 9);
        $n4 = random_int(0, 9);
        $n5 = random_int(0, 9);
        $n6 = random_int(0, 9);
        $n7 = random_int(0, 9);
        $n8 = random_int(0, 9);
        $n9 = random_int(0, 9);
        $d1 = $n9 * 2 + $n8 * 3 + $n7 * 4 + $n6 * 5 + $n5 * 6 + $n4 * 7 + $n3 * 8 + $n2 * 9 + $n1 * 10;
        $d1 = 11 - (self::mod($d1));
        if ($d1 >= 10) {
            $d1 = 0;
        }
        $d2 = $d1 * 2 + $n9 * 3 + $n8 * 4 + $n7 * 5 + $n6 * 6 + $n5 * 7 + $n4 * 8 + $n3 * 9 + $n2 * 10 + $n1 * 11;
        $d2 = 11 - (self::mod($d2));
        if ($d2 >= 10) {
            $d2 = 0;
        }
        $result = ''.$n1.$n2.$n3.$n4.$n5.$n6.$n7.$n8.$n9.$d1.$d2;

        return new self($result);
    }

    private static function mod(int|float $dividend): float
    {
        return round($dividend - (floor($dividend / 11) * 11));
    }

    public static function validate(string|int $value): bool
    {
        $doc = self::sanitize($value);

        if (strlen($doc) != 11 or preg_match('/(\d)\1{10}/', $doc)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $doc[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($doc[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    /**
     * @throws IFurryDomainCoreException
     */
    public static function create(string|int $value): IRegistrationDocument
    {
        $value = self::sanitize($value);

        if (! self::validate($value)) {
            throw FurryDomainCoreException::invalidArgument('Invalid CPF.');
        }

        return new self($value);
    }
}
