<?php

declare(strict_types=1);

use Carbon\Carbon;
use FurryFinds\Domain\Core\Exceptions\FurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\ICreatedAt;
use FurryFinds\Domain\Core\ValueObjects\CreatedAt;

test('Deve retornar true quando uma data valida for passada como string')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(CreatedAt::validate('2021-01-01 00:00:00'))->toBeTrue();

test('Deve retornar false quando uma data invalida for passada como string')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(CreatedAt::validate(''))->toBeFalse();

test('Deve retornar true quando uma data valida for passada como CarbonInterface')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(CreatedAt::validate(Carbon::now()))->toBeTrue();

test('Deve retornar true quando uma data valida for passa como DateTimeInterface')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(CreatedAt::validate(new DateTime()))->toBeTrue();

test('Deve criar uma nova instancia de CreatedAt com uma data valida como string')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(CreatedAt::create('2021-01-01 00:00:00'))->toBeInstanceOf(ICreatedAt::class);

test('Deve criar uma nova instancia de CreatedAt com uma data valida como CarbonInterface')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(CreatedAt::create(Carbon::now()))->toBeInstanceOf(ICreatedAt::class);

test('Deve criar uma nova instancia de CreatedAt com uma data valida como DateTimeInterface')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(CreatedAt::create(new DateTime()))->toBeInstanceOf(ICreatedAt::class);

test('Deve lancar uma excecao quando uma data invalida for passada como string')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->throws(FurryDomainCoreException::class)
    ->expect(fn () => CreatedAt::create(''));

test('Deve retornar uma string no formato Y-m-d H:i:s quando o metodo __toString for chamado')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect((string) CreatedAt::create('2021-01-01 00:00:00'))->toBe('2021-01-01T00:00:00.000000Z');

test('Deve retornar uma instancia de CarbonInterface quando o metodo getCarbon for chamado')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(CreatedAt::create('2021-01-01 00:00:00')->getCarbon())->toBeInstanceOf(Carbon::class);

test('Deve retornar uma instancia de DateTimeInterface quando o metodo getValue for chamado')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(CreatedAt::create('2021-01-01 00:00:00')->getValue())->toBeInstanceOf(DateTime::class);

test('Deve retornar uma string formatada quando o metodo format for chamado')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(CreatedAt::create('2021-01-01 00:00:00')->format('Y'))->toBe('2021');

test('Deve retornar uma instancia de ICreatedAt quando o metodo random for chamado')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(CreatedAt::random())->toBeInstanceOf(ICreatedAt::class);

test('Deve retornar uma instancia de ICreatedAt quando o metodo now for chamado')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(CreatedAt::now())->toBeInstanceOf(ICreatedAt::class);
