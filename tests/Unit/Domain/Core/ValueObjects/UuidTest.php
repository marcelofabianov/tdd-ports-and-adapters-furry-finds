<?php

declare(strict_types=1);

use FurryFinds\Domain\Core\Exceptions\FurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IUuid;
use FurryFinds\Domain\Core\ValueObjects\Uuid;

test('Deve retornar true quando validado um UUID valido')
    ->group('Uuid', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Uuid::validate('629b8631-622a-4fee-8497-e46d37ae48fe'))->toBeTrue();

test('Deve retornar false quando validado um UUID invalido')
    ->group('Uuid', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Uuid::validate('629b8631-622a-4fee-8497-e46d37ae48f'))->toBeFalse();

test('Deve retonar uma nova instancia quando o UUID informado fo valido')
    ->group('Uuid', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Uuid::create('629b8631-622a-4fee-8497-e46d37ae48fe'))->toBeInstanceOf(IUuid::class);

test('Deve lancar uma exception quando o UUID informado for invalido ao tentar criar uma instancia')
    ->group('Uuid', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->throws(FurryDomainCoreException::class)
    ->expect(fn () => Uuid::create('629b8631-622a-4fee-8497-e46d37ae48f'));

test('Deve lancar uma exception quando informado uma string vazia ao tentar criar uma instancia')
    ->group('Uuid', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->throws(FurryDomainCoreException::class)
    ->expect(fn () => Uuid::create(''));

test('Deve retornar uma nova instancia com UUID gerado aleatoriamente valido')
    ->group('Uuid', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Uuid::random())->toBeInstanceOf(IUuid::class)
    ->and(Uuid::validate(Uuid::random()->getValue()))->toBeTrue();

test('Deve retornar true quando comparado dois UUIDs iguais')
    ->group('Uuid', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Uuid::create('629b8631-622a-4fee-8497-e46d37ae48fe')->equals(Uuid::create('629b8631-622a-4fee-8497-e46d37ae48fe')))->toBeTrue();

test('Deve retornar false quando comparado dois UUIDs diferentes')
    ->group('Uuid', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Uuid::create('629b8631-622a-4fee-8497-e46d37ae48fe')->equals(Uuid::create('629b8631-622a-4fee-8497-e46d37ae48f1')))->toBeFalse();

test('Deve retornar o valor do UUID quando chamado o metodo __toString')
    ->group('Uuid', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect((string) Uuid::create('629b8631-622a-4fee-8497-e46d37ae48fe'))->toBe('629b8631-622a-4fee-8497-e46d37ae48fe');

test('Deve retornar o valor do UUID armazenado')
    ->group('Uuid', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect('629b8631-622a-4fee-8497-e46d37ae48fe')->toBe(Uuid::create('629b8631-622a-4fee-8497-e46d37ae48fe')->getValue());
