<?php

declare(strict_types=1);

namespace FurryFinds\Domain\Core\ValueObjects;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use DateTimeInterface;
use Exception;
use FurryFinds\Domain\Core\Exceptions\FurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\ICreatedAt;

final readonly class CreatedAt implements ICreatedAt
{
    private function __construct(
        private DateTimeInterface $value
    ) {
    }

    public function __toString(): string
    {
        return $this->toISOString();
    }

    public function getValue(): DateTimeInterface
    {
        return $this->value;
    }

    public function getCarbon(): CarbonInterface
    {
        return Carbon::instance($this->value);
    }

    public function format(string $format): string
    {
        return $this->value->format($format);
    }

    public function toISOString(): string
    {
        return $this->value->format('Y-m-d\TH:i:s.u\Z');
    }

    public static function now(): ICreatedAt
    {
        return new self(Carbon::now());
    }

    /**
     * @throws Exception
     */
    public static function random(): ICreatedAt
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

    public static function validate(string|CarbonInterface|DateTimeInterface $value): bool
    {
        if (is_string($value) && $value !== '') {
            try {
                return Carbon::parse($value)->isValid();
            } catch (Exception) {
                return false;
            }
        }

        if ($value instanceof CarbonInterface) {
            return true;
        }

        if ($value instanceof DateTimeInterface) {
            return true;
        }

        return false;
    }

    /**
     * @throws FurryDomainCoreException
     */
    public static function create(string|CarbonInterface|DateTimeInterface $value): ICreatedAt
    {
        if ($value instanceof DateTimeInterface) {
            return new self($value);
        }

        if (! self::validate($value)) {
            throw FurryDomainCoreException::invalidArgument('Invalid created at value');
        }

        if (is_string($value)) {
            try {
                return new self(Carbon::parse($value));
            } catch (Exception) {
                throw FurryDomainCoreException::invalidArgument('Invalid created at value');
            }
        }

        throw FurryDomainCoreException::invalidArgument('Invalid created at value');
    }
}
