<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\ValueObjects;

use FurryFinds\Domain\Core\Enums\RegistrationDocumentTypeEnum;
use FurryFinds\Domain\Core\Exceptions\FurryDomainCoreException;
use FurryFinds\Domain\Core\Helpers\ApplyMask;
use FurryFinds\Domain\Core\Interfaces\Exceptions\IFurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\ICnpj;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IRegistrationDocument;

final readonly class Cnpj implements ICnpj
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

    public function getValue(): ICnpj
    {
        return $this;
    }

    public function isMatrix(): bool
    {
        return str_contains($this->numbers(), '0001');
    }

    public function prefixMatrix(): string
    {
        return substr($this->numbers(), 0, 8).'0001';
    }

    public function root(): string
    {
        $cnpj = $this->numbers();

        return substr($cnpj, 0, 8);
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
        return ApplyMask::custom($this->value, '##.###.###/####-##');
    }

    public function type(): string
    {
        return RegistrationDocumentTypeEnum::CNPJ->value;
    }

    public static function sanitize(string|int $value): string
    {
        if (is_int($value)) {
            $value = (string) $value;
        }

        return preg_replace(pattern: '/[^0-9]/', replacement: '', subject: $value);
    }

    public static function random(RegistrationDocumentTypeEnum $type = RegistrationDocumentTypeEnum::CNPJ): ICnpj
    {
        $n1 = random_int(0, 9);
        $n2 = random_int(0, 9);
        $n3 = random_int(0, 9);
        $n4 = random_int(0, 9);
        $n5 = random_int(0, 9);
        $n6 = random_int(0, 9);
        $n7 = random_int(0, 9);
        $n8 = random_int(0, 9);
        $n9 = 0;
        $n10 = 0;
        $n11 = 0;
        $n12 = 1;

        $d1 = $n12 * 2 + $n11 * 3 + $n10 * 4 + $n9 * 5 + $n8 * 6 + $n7 * 7 + $n6 * 8 + $n5 * 9 + $n4 * 2 + $n3 * 3 + $n2 * 4 + $n1 * 5;
        $d1 = 11 - (self::mod($d1));
        if ($d1 >= 10) {
            $d1 = 0;
        }

        $d2 = $d1 * 2 + $n12 * 3 + $n11 * 4 + $n10 * 5 + $n9 * 6 + $n8 * 7 + $n7 * 8 + $n6 * 9 + $n5 * 2 + $n4 * 3 + $n3 * 4 + $n2 * 5 + $n1 * 6;
        $d2 = 11 - (self::mod($d2));
        if ($d2 >= 10) {
            $d2 = 0;
        }

        $result = ''.$n1.$n2.$n3.$n4.$n5.$n6.$n7.$n8.$n9.$n10.$n11.$n12.$d1.$d2;

        return new self($result);
    }

    private static function mod(int|float $dividend): float
    {
        return round($dividend - (floor($dividend / 11) * 11));
    }

    public static function validate(string|int $value): bool
    {
        $value = self::sanitize($value);

        if (strlen($value) !== 14 || preg_match('/(\d)\1{13}/', $value)) {
            return false;
        }

        for ($i = 0, $j = 5, $sum = 0; $i < 12; $i++) {
            $sum += $value[$i] * $j;
            $j = ($j === 2) ? 9 : $j - 1;
        }

        $remainder = $sum % 11;

        if ($value[12] != ($remainder < 2 ? 0 : 11 - $remainder)) {
            return false;
        }

        for ($i = 0, $j = 6, $sum = 0; $i < 13; $i++) {
            $sum += $value[$i] * $j;
            $j = ($j === 2) ? 9 : $j - 1;
        }

        $remainder = $sum % 11;

        return $value[13] == ($remainder < 2 ? 0 : 11 - $remainder);
    }

    /**
     * @throws IFurryDomainCoreException
     */
    public static function create(string|int $value): IRegistrationDocument
    {
        $value = self::sanitize($value);

        if (! self::validate($value)) {
            throw FurryDomainCoreException::invalidArgument('Invalid CNPJ');
        }

        return new self($value);
    }
}
