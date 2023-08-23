<?php

declare(strict_types=1);

use FurryFinds\Domain\Core\Exceptions\FurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IMonetary;
use FurryFinds\Domain\Core\ValueObjects\Monetary;

test('Deve retornar true quando validar um valor do tipo string que tem extamente o valores zerados suportados')
    ->group('Monetary', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Monetary::validate('0.00'))->toBeTrue()
    ->and(Monetary::validate('0.0'))->toBeTrue()
    ->and(Monetary::validate('0'))->toBeTrue()
    ->and(Monetary::validate('.0'))->toBeTrue()
    ->and(Monetary::validate('.00'))->toBeTrue()
    ->and(Monetary::validate('.000'))->toBeTrue();

test('Deve retornar false quando validado uma string com valor monetario invalido')
    ->group('Monetary', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Monetary::validate('invalid'))->toBeFalse()
    ->and(Monetary::validate('.343'))->toBeFalse()
    ->and(Monetary::validate('.34'))->toBeFalse()
    ->and(Monetary::validate('.2'))->toBeFalse()
    ->and(Monetary::validate('1.000,0'))->toBeFalse()
    ->and(Monetary::validate('1,0'))->toBeFalse()
    ->and(Monetary::validate('1.0'))->toBeFalse()
    ->and(Monetary::validate('1.000,000'))->toBeFalse();

test('Deve retornar true quando validado uma string com valor monetario valido')
    ->group('Monetary', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Monetary::validate('1.23'))->toBeTrue()
    ->and(Monetary::validate('1.00'))->toBeTrue()
    ->and(Monetary::validate('1,23'))->toBeTrue()
    ->and(Monetary::validate('1,00'))->toBeTrue()
    ->and(Monetary::validate('100,00'))->toBeTrue()
    ->and(Monetary::validate('134,20'))->toBeTrue()
    ->and(Monetary::validate('3454,34'))->toBeTrue()
    ->and(Monetary::validate('3454.34'))->toBeTrue()
    ->and(Monetary::validate('3.454,34'))->toBeTrue()
    ->and(Monetary::validate('42.23'))->toBeTrue()
    ->and(Monetary::validate('142.00'))->toBeTrue();

test('Deve retornar true quando validado um float com valor monetario valido')
    ->group('Monetary', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Monetary::validate(1.23))->toBeTrue()
    ->and(Monetary::validate(1.00))->toBeTrue()
    ->and(Monetary::validate(1435.00))->toBeTrue()
    ->and(Monetary::validate(1435.44))->toBeTrue()
    ->and(Monetary::validate(435.44))->toBeTrue()
    ->and(Monetary::validate(435.00))->toBeTrue();

test('Deve retornar true quando validado um int com valor monetario valido')
    ->group('Monetary', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Monetary::validate(1))->toBeTrue()
    ->and(Monetary::validate(1435))->toBeTrue()
    ->and(Monetary::validate(435))->toBeTrue();

test('Deve criar uma instancia a partir de um valor monetario string')
    ->group('Monetary', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Monetary::create('0.34'))->toBeInstanceOf(IMonetary::class)
    ->and(Monetary::create('0.34')->getValue())->toBe(0.34);

test('Deve criar uma instancia a partir de um valor monetario float')
    ->group('Monetary', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Monetary::create(2.23))->toBeInstanceOf(IMonetary::class)
    ->and(Monetary::create(2.23)->getValue())->toBe(2.23);

test('Deve criar uma instancia a partir de um valor monetario int')
    ->group('Monetary', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Monetary::create(343))->toBeInstanceOf(IMonetary::class)
    ->and(Monetary::create(343)->getValue())->toBe(343.00);

test('Deve lancar uma exception quando valor para criar uma instancia é invalido não monetario uma palavra')
    ->group('Monetary', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->throws(FurryDomainCoreException::class)
    ->expect(fn () => Monetary::create('invalido'));

test('Deve lancar uma exception quando valor para criar uma instancia é invalido um monetario irregular')
    ->group('Monetary', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->throws(FurryDomainCoreException::class)
    ->expect(fn () => Monetary::create('.54'));

test('Deve criar uma instancia com um valor aleatorio')
    ->group('Unit', 'Domain', 'Core', 'ValueObjects', 'Monetary')
    ->expect(Monetary::random())->toBeInstanceOf(IMonetary::class);

test('Deve retornar string com o valor formatado para exibicao chamando o metodo format()')
    ->group('Unit', 'Domain', 'Core', 'ValueObjects', 'Monetary')
    ->and(Monetary::create('1343.43')->format())->toBe('1.343,43');

test('Deve retornar o valor armazenando float quando usado metodo getValue()')
    ->group('Unit', 'Domain', 'Core', 'ValueObjects', 'Monetary')
    ->expect(Monetary::create(3454.34)->getValue())->toBe(3454.34)
    ->and(Monetary::create('3.454,34')->getValue())->toBe(3454.34);

test('Deve retornar string quando usado metodo __toString()')
    ->group('Unit', 'Domain', 'Core', 'ValueObjects', 'Monetary')
    ->expect(Monetary::create(3454.34)->__toString())->toBe('3454.34')
    ->and(Monetary::create('3.454,34')->__toString())->toBe('3454.34')
    ->and((string) Monetary::create('3.454,34'))->toBe('3454.34')
    ->and((string) Monetary::create(3454.34))->toBe('3454.34');

test('Deve retornar o valor float de valor string')
    ->group('Unit', 'Domain', 'Core', 'ValueObjects', 'Monetary')
    ->expect(Monetary::sanitize('1.23'))->toBe(1.23)
    ->and(Monetary::sanitize('1.00'))->toBe(1.00)
    ->and(Monetary::sanitize('1,23'))->toBe(1.23)
    ->and(Monetary::sanitize('1,00'))->toBe(1.00)
    ->and(Monetary::sanitize('100,00'))->toBe(100.00)
    ->and(Monetary::sanitize('134,20'))->toBe(134.20)
    ->and(Monetary::sanitize('3454,34'))->toBe(3454.34)
    ->and(Monetary::sanitize('3454.34'))->toBe(3454.34)
    ->and(Monetary::sanitize('3.454,34'))->toBe(3454.34)
    ->and(Monetary::sanitize('42.23'))->toBe(42.23)
    ->and(Monetary::sanitize('142.00'))->toBe(142.00);

test('Deve retornar true quando comparado se duas instancias sao iguais')
    ->group('Unit', 'Domain', 'Core', 'ValueObjects', 'Monetary')
    ->expect(Monetary::create(3454.34)->equals(Monetary::create('3.454,34')))->toBeTrue()
    ->and(Monetary::create('3.454,34')->equals(Monetary::create(3454.34)))->toBeTrue()
    ->and(Monetary::create('3454,34')->equals(Monetary::create(3454.34)))->toBeTrue();

test('Deve retornar false quando comparado as instancias diferentes')
    ->group('Unit', 'Domain', 'Core', 'ValueObjects', 'Monetary')
    ->expect(Monetary::create(3454.34)->equals(Monetary::create('3.454,00')))->toBeFalse();
