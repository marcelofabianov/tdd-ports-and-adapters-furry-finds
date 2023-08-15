<?php

declare(strict_types=1);

use FurryFinds\Domain\Core\Enums\ExternalCodeTypeEnum;
use FurryFinds\Domain\Core\Exceptions\FurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IExternalCode;
use FurryFinds\Domain\Core\ValueObjects\ExternalCode;

test('Deve retornar true quando informado um codigo externo valido')
    ->group('ExternalCode', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(ExternalCode::validate(7773))->toBeTrue()
    ->and(ExternalCode::validate('455'))->toBeTrue()
    ->and(ExternalCode::validate('5fd639ce-f7cc-4693-b6b8-f066ba174e32'))->toBeTrue();

test('Deve retornar false quando informado um codigo externo invalido')
    ->group('ExternalCode', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(ExternalCode::validate(''))->toBeFalse()
    ->and(ExternalCode::validate('0'))->toBeFalse()
    ->and(ExternalCode::validate(0))->toBeFalse()
    ->and(ExternalCode::validate('5fd639ce-f7cc-4693-b6b8-f066ba174e3'))->toBeTrue();

test('Deve gerar um codigo externo aleatorio do tipo uuid em uma nova instancia')
    ->group('ExternalCode', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(ExternalCode::random(ExternalCodeTypeEnum::uuid))->toBeInstanceOf(IExternalCode::class);

test('Deve gerar um codigo externo aleatorio do tipo integer em uma nova instancia')
    ->group('ExternalCode', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(ExternalCode::random(ExternalCodeTypeEnum::integer))->toBeInstanceOf(IExternalCode::class);

test('Deve comparar dois codigos externos e retornar true quando forem iguais')
    ->group('ExternalCode', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(ExternalCode::create(1024)->equals(ExternalCode::create(1024)))->toBeTrue()
    ->and(ExternalCode::create('454')->equals(ExternalCode::create('454')))->toBeTrue()
    ->and(ExternalCode::create('5fd639ce-f7cc-4693-b6b8-f066ba174e32')->equals(ExternalCode::create('5fd639ce-f7cc-4693-b6b8-f066ba174e32')))->toBeTrue();

test('Deve comparar dois codigos externos e retornar false quando forem diferentes')
    ->group('ExternalCode', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(ExternalCode::create(1024)->equals(ExternalCode::create(1025)))->toBeFalse()
    ->and(ExternalCode::create('454')->equals(ExternalCode::create('455')))->toBeFalse()
    ->and(ExternalCode::create('5fd639ce-f7cc-4693-b6b8-f066ba174e32')->equals(ExternalCode::create('5fd639ce-f7cc-4693-b6b8-f066ba174e33')))->toBeFalse();

test('Deve criar uma nova instancia quando codigo externo for valido')
    ->group('ExternalCode', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(ExternalCode::create(1024))->toBeInstanceOf(IExternalCode::class)
    ->and(ExternalCode::create('454'))->toBeInstanceOf(IExternalCode::class)
    ->and(ExternalCode::create('5fd639ce-f7cc-4693-b6b8-f066ba174e32'))->toBeInstanceOf(IExternalCode::class);

test('Deve lancar uma excecao quando codigo externo for invalido')
    ->group('ExternalCode', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->throws(FurryDomainCoreException::class)
    ->expect(fn () => ExternalCode::create(''));

test('Deve lancar uma excesao quando o codigo externo for zero')
    ->group('ExternalCode', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->throws(FurryDomainCoreException::class)
    ->expect(fn () => ExternalCode::create(0));

test('Deve retornar o valor do codigo externo')
    ->group('ExternalCode', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(ExternalCode::create(2335)->getValue())->toBe(2335)
    ->and(ExternalCode::create('5454')->getValue())->toBe('5454')
    ->and(ExternalCode::create('5fd639ce-f7cc-4693-b6b8-f066ba174e32')->getValue())->toBe('5fd639ce-f7cc-4693-b6b8-f066ba174e32');

test('Deve retornar um string do valor quando chamado o metodo __toString')
    ->group('ExternalCode', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect((string) ExternalCode::create(1024))->toBe('1024')
    ->and((string) ExternalCode::create('454'))->toBe('454')
    ->and((string) ExternalCode::create('5fd639ce-f7cc-4693-b6b8-f066ba174e32'))->toBe('5fd639ce-f7cc-4693-b6b8-f066ba174e32');
