<?php

declare(strict_types=1);

use Carbon\Carbon;
use FurryFinds\Domain\Core\ValueObjects\InactivatedAt;

test('Deve retornar true quando informado um valor de um data como string valida')
    ->expect(InactivatedAt::validate('2021-01-01'))->toBeTrue();

test('Deve retornar true quando informado um valor de um data como CarbonInterface valida')
    ->expect(InactivatedAt::validate(Carbon::now()))->toBeTrue();

test('Deve retornar true quando informado um valor de um data como DateTimeInterface valida')
    ->expect(InactivatedAt::validate(new DateTime()))->toBeTrue();

test('Deve retornar false quando informado um valor de um data como string invalida')
    ->expect(InactivatedAt::validate('invalid'))->toBeFalse();

test('Deve criar uma nova instancia de InactivatedAt com valor inicial null')
    ->expect(InactivatedAt::create(null)->getValue())->toBeNull();

test('Deve retornar valor null ao chamar o método nullable()')
    ->expect(InactivatedAt::nullable())->toBeNull();

test('Deve retornar true quando verificado se o valor da instancia esta como null')
    ->expect(InactivatedAt::create(null)->isNull())->toBeTrue();

test('Deve retornar false quando verificado se o valor da instancia esta como null')
    ->expect(InactivatedAt::create(new DateTime())->isNull())->toBeFalse();

test('Deve retornar uma nova instancia de InactivatedAt com valor inicial igual a data atual')
    ->expect(InactivatedAt::now()->getValue())->toBeInstanceOf(DateTime::class);

test('Deve retornar uma nova instancia de InactivatedAt com valor randomico')
    ->expect(InactivatedAt::random()->getValue())->toBeInstanceOf(DateTime::class);

test('Deve retornar uma string no formato Y-m-d H:i:s quando o metodo __toString for chamado')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect((string) InactivatedAt::create('2021-01-01 00:00:00'))->toBe('2021-01-01T00:00:00.000000Z');

test('Deve retornar uma instancia de CarbonInterface quando o metodo getCarbon for chamado')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(InactivatedAt::create('2021-01-01 00:00:00')->getCarbon())->toBeInstanceOf(Carbon::class);

test('Deve retornar uma instancia de DateTimeInterface quando o metodo getValue for chamado')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(InactivatedAt::create('2021-01-01 00:00:00')->getValue())->toBeInstanceOf(DateTime::class);

test('Deve retornar uma string formatada quando o metodo format for chamado')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(InactivatedAt::create('2021-01-01 00:00:00')->format('Y'))->toBe('2021');

test('Deve retornar uma string no formato Y-m-d H:i:s quando o metodo toISOString for chamado')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(InactivatedAt::create('2021-01-01 00:00:00')->toISOString())->toBe('2021-01-01T00:00:00.000000Z');

test('Deve retornar uma string no formato Y-m-d H:i:s quando o metodo format for chamado')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(InactivatedAt::create('2021-01-01 00:00:00')->format())->toBe('2021-01-01 00:00:00');

test('Deve retornar null quando o metodo toISOString for chamado e o valor da instancia for null')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(InactivatedAt::create(null)->toISOString())->toBeNull();

test('Deve retornar null quando o metodo format for chamado e o valor da instancia for null')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(InactivatedAt::create(null)->format())->toBeNull();

test('Deve retornar null quando o metodo getValue for chamado e o valor da instancia for null')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(InactivatedAt::create(null)->getValue())->toBeNull();

test('Deve retornar null quando o metodo getCarbon for chamado e o valor da instancia for null')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(InactivatedAt::create(null)->getCarbon())->toBeNull();

test('Deve retornar string vazia quando o metodo __toString for chamado e o valor da instancia for null')
    ->group('CreatedAt', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect((string) InactivatedAt::create(null))->toBe('');
