<?php

declare(strict_types=1);

use Carbon\Carbon;
use FurryFinds\Domain\Core\Exceptions\FurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IUpdatedAt;
use FurryFinds\Domain\Core\ValueObjects\UpdatedAt;

test('Deve retornar true quando uma data valida for passada como string')
    ->group('UpdatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(UpdatedAt::validate('2021-01-01 00:00:00'))->toBeTrue();

test('Deve retornar false quando uma data invalida for passada como string')
    ->group('UpdatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(UpdatedAt::validate(''))->toBeFalse();

test('Deve retornar true quando uma data valida for passada como CarbonInterface')
    ->group('UpdatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(UpdatedAt::validate(Carbon::now()))->toBeTrue();

test('Deve retornar true quando uma data valida for passa como DateTimeInterface')
    ->group('UpdatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(UpdatedAt::validate(new DateTime()))->toBeTrue();

test('Deve criar uma nova instancia de UpdatedAt com uma data valida como string')
    ->group('UpdatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(UpdatedAt::create('2021-01-01 00:00:00'))->toBeInstanceOf(IUpdatedAt::class);

test('Deve criar uma nova instancia de UpdatedAt com uma data valida como CarbonInterface')
    ->group('UpdatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(UpdatedAt::create(Carbon::now()))->toBeInstanceOf(IUpdatedAt::class);

test('Deve criar uma nova instancia de UpdatedAt com uma data valida como DateTimeInterface')
    ->group('UpdatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(UpdatedAt::create(new DateTime()))->toBeInstanceOf(IUpdatedAt::class);

test('Deve lancar uma excecao quando uma data invalida for passada como string')
    ->group('UpdatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->throws(FurryDomainCoreException::class)
    ->expect(fn () => UpdatedAt::create(''));

test('Deve retornar uma string no formato Y-m-d H:i:s quando o metodo __toString for chamado')
    ->group('UpdatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect((string) UpdatedAt::create('2021-01-01 00:00:00'))->toBe('2021-01-01T00:00:00.000000Z');

test('Deve retornar uma instancia de CarbonInterface quando o metodo getCarbon for chamado')
    ->group('UpdatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(UpdatedAt::create('2021-01-01 00:00:00')->getCarbon())->toBeInstanceOf(Carbon::class);

test('Deve retornar uma instancia de DateTimeInterface quando o metodo getValue for chamado')
    ->group('UpdatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(UpdatedAt::create('2021-01-01 00:00:00')->getValue())->toBeInstanceOf(DateTime::class);

test('Deve retornar uma string formatada quando o metodo format for chamado')
    ->group('UpdatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(UpdatedAt::create('2021-01-01 00:00:00')->format('Y'))->toBe('2021');

test('Deve retornar uma instancia de IUpdatedAt quando o metodo random for chamado')
    ->group('UpdatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(UpdatedAt::random())->toBeInstanceOf(IUpdatedAt::class);

test('Deve retornar uma instancia de IUpdatedAt quando o metodo now for chamado')
    ->group('UpdatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(UpdatedAt::now())->toBeInstanceOf(IUpdatedAt::class);
