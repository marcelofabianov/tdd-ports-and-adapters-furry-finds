<?php

declare(strict_types=1);

use FurryFinds\Domain\Core\Exceptions\FurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\ICpf;
use FurryFinds\Domain\Core\ValueObjects\Cpf;

test('Deve retornar false quando passado int zero como CPF')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::validate(0))->toBeFalse();

test('Deve retornar false quando passado string zero como CPF')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::validate('0'))->toBeFalse();

test('Deve retornar false quando passado string vazia como CPF')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::validate(''))->toBeFalse();

test('Deve retornar false quando passado int caracteres iguais')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::validate(11111111111))->toBeFalse();

test('Deve retornar false quando passado string caracteres iguais')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::validate('11111111111'))->toBeFalse();

test('Deve retornar false quando passado string de caracteres sequenciais de 0 a 9')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::validate('0123456789'))->toBeFalse();

test('Deve retornar false quando passado int de caracteres sequenciais de 1 a 10')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::validate(12345678910))->toBeFalse();

test('Deve retornar false quando passado string de caracteres sequenciais 1 a 10')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::validate('12345678910'))->toBeFalse();

test('Deve retonar true quando passado um CPF valido como inteiro')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::validate(78226510058))->toBeTrue();

test('Deve retornar true quando validacao do CPF for valida')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::validate('64014695018'))->toBeTrue();

test('Deve retornar false quando validacao do CPF for invalida')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::validate('64014695019'))->toBeFalse();

test('Deve retornar false quando passado um CNPJ como CPF')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::validate('13722785000158'))->toBeFalse();

test('Deve retornar true quando passado um CPF com mascara')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::validate('640.146.950-18'))->toBeTrue();

test('Deve retornar true quando o CPF for verificado como matriz')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::create('784.060.760-89')->isMatrix())->toBeTrue();

test('Deve criar uma nova instancia quando o CPF passado for valido')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::create('03303340005'))->toBeInstanceOf(ICpf::class);

test('Deve criar uma nova instancia quando o CPF passado com mascara for valido')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::create('033.033.400-05'))->toBeInstanceOf(ICpf::class);

test('Deve lancar uma excecao quando o CPF passado com mascara for invalido')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->throws(FurryDomainCoreException::class)
    ->expect(fn () => Cpf::create('033.033.400-06'));

test('Deve lancar uma excecao quando o CPF passado for invalido')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->throws(FurryDomainCoreException::class)
    ->expect(fn () => Cpf::create('03303340006'));

test('Deve lancar uma exececao quando o CPF passado for um CNPJ para criar uma nova instancia')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->throws(FurryDomainCoreException::class)
    ->expect(fn () => Cpf::create('13722785000158'));

test('Deve retornar o CPF formatado')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::create('78406076089')->mask())->toBe('784.060.760-89');

test('Deve retornar o CPF sem formatacao somente numeros')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::create('784.060.760-89')->numbers())->toBe('78406076089');

test('Deve retornar o CPF quando o metodo __toString for chamado')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect((string) Cpf::create('784.060.760-89'))->toBe('78406076089');

test('Deve retornar o CPF quando o metodo jsonSerialize for chamado')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::create('784.060.760-89')->jsonSerialize())->toBe([
        'type' => 'CPF',
        'value' => '78406076089',
        'mask' => '784.060.760-89',
    ]);

test('Deve retornar o tipo do documento CPF')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::create('784.060.760-89')->type())->toBe('CPF');

test('Deve retornar uma instancia de CPF com valor aleatorio valido')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::random())->toBeInstanceOf(ICpf::class)
    ->and(Cpf::validate(Cpf::random()->numbers()))->toBeTrue();

test('Deve retornar o CPF quando solicitado prefixo matriz')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::create('784.060.760-89')->prefixMatrix())->toBe('78406076089');

test('Deve retornar o CPF quando solicitado a raiz do documento')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::create('784.060.760-89')->root())->toBe('784060760');

test('Deve retornar os digitos verificadores do CPF')
    ->group('Cpf', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cpf::create('784.060.760-89')->digits())->toBe('89');
