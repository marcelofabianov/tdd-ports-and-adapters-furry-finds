<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\ValueObjects;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use DateTimeInterface;
use Exception;
use FurryFinds\Domain\Core\Exceptions\FurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IInactivatedAt;

final readonly class InactivatedAt implements IInactivatedAt
{
    private function __construct(
        private DateTimeInterface|null $value
    ) {
    }

    public function __toString(): string
    {
        if (is_null($this->value)) {
            return '';
        }

        return $this->toISOString();
    }

    public function getValue(): DateTimeInterface|null
    {
        return $this->value;
    }

    public function getCarbon(): CarbonInterface|null
    {
        if (is_null($this->value)) {
            return null;
        }

        return Carbon::instance($this->value);
    }

    public function format(string $format = 'Y-m-d H:i:s'): string|null
    {
        if (is_null($this->value)) {
            return null;
        }

        return $this->value->format($format);
    }

    public function toISOString(): string|null
    {
        if (is_null($this->value)) {
            return null;
        }

        return $this->value->format('Y-m-d\TH:i:s.u\Z');
    }

    /**
     * @throws Exception
     */
    public static function random(): IInactivatedAt
    {
        return new self(
            Carbon::now()
                ->subDays(random_int(1, 365))
                ->subMonths(random_int(1, 12))
                ->subYears(random_int(1, 10))
                ->subHours(random_int(1, 24))
                ->subMinutes(random_int(1, 60))
        );
    }

    public static function now(): IInactivatedAt
    {
        return new self(Carbon::now());
    }

    public static function validate(string|CarbonInterface|DateTimeInterface $value): bool
    {
        if ($value instanceof CarbonInterface) {
            return true;
        }

        if ($value instanceof DateTimeInterface) {
            return true;
        }

        if (is_string($value) && $value !== '') {
            try {
                return Carbon::parse($value)->isValid();
            } catch (Exception) {
                return false;
            }
        }

        return false;
    }

    public function isNull(): bool
    {
        return is_null($this->value);
    }

    public static function nullable(): null
    {
        return null;
    }

    /**
     * @throws FurryDomainCoreException
     */
    public static function create(string|CarbonInterface|DateTimeInterface|null $value): IInactivatedAt
    {
        if ($value === null) {
            return new self(null);
        }

        if ($value instanceof DateTimeInterface) {
            return new self($value);
        }

        if (! self::validate($value)) {
            throw FurryDomainCoreException::invalidArgument('Invalid inactivatedAt.');
        }

        if (is_string($value)) {
            try {
                return new self(Carbon::parse($value));
            } catch (Exception) {
                throw FurryDomainCoreException::invalidArgument('Invalid inactivatedAt.');
            }
        }

        throw FurryDomainCoreException::invalidArgument('Invalid inactivatedAt.');
    }
}
