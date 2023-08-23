<?php

declare(strict_types=1);

use FurryFinds\Domain\Core\Exceptions\FurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\ICnpj;
use FurryFinds\Domain\Core\ValueObjects\Cnpj;

test('Deve retornar false quando passado int zero como Cnpj')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::validate(0))->toBeFalse();

test('Deve retornar false quando passado string zero como Cnpj')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::validate('0'))->toBeFalse();

test('Deve retornar false quando passado string vazia como Cnpj')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::validate(''))->toBeFalse();

test('Deve retornar false quando passado int caracteres iguais')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::validate(11111111111111))->toBeFalse();

test('Deve retornar false quando passado string caracteres iguais')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::validate('11111111111111'))->toBeFalse();

test('Deve retornar false quando passado string de caracteres sequenciais de 0 a 11')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::validate('01234567891011'))->toBeFalse();

test('Deve retornar false quando passado int de caracteres sequenciais de 1 a 12')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::validate(123456789101112))->toBeFalse();

test('Deve retornar false quando passado string de caracteres sequenciais 1 a 10')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::validate('123456789101112'))->toBeFalse();

test('Deve retornar true quando passado um CNPJ valido como inteiro')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::validate(13722785000158))->toBeTrue();

test('Deve retornar true quando validacao do CNPJ for valida')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::validate('13722785000158'))->toBeTrue();

test('Deve retornar false quando validacao do CNPJ for invalida')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::validate('13722785000159'))->toBeFalse();

test('Deve retornar false quando passado um Cnpj como CNPJ')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::validate('20259645010'))->toBeFalse()
    ->and(Cnpj::validate('20259645010'))->toBeFalse();

test('Deve retornar true quando passado um CNPJ com mascara')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::validate('13.722.785/0001-58'))->toBeTrue();

test('Deve criar uma nova instancia quando o CNPJ passado for valido')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::create('13722785000158'))->toBeInstanceOf(ICnpj::class);

test('Deve criar uma nova instancia quando o CNPJ passado com mascara for valido')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::create('13.722.785/0001-58'))->toBeInstanceOf(ICnpj::class);

test('Deve lancar uma excecao quando o CNPJ passado com mascara for invalido')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->throws(FurryDomainCoreException::class)
    ->expect(fn () => Cnpj::create('13.722.785/0001-59'));

test('Deve lancar uma excecao quando o CNPJ passado for invalido')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->throws(FurryDomainCoreException::class)
    ->expect(fn () => Cnpj::create('13722785000159'));

test('Deve lancar uma exececao quando o CNPJ passado for um CPF para criar uma nova instancia')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->throws(FurryDomainCoreException::class)
    ->expect(fn () => Cnpj::create('20259645010'));

test('Deve retornar o CNPJ formatado')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::create('13722785000158')->mask())->toBe('13.722.785/0001-58');

test('Deve retornar o CNPJ sem formatacao somente numeros')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::create('13.722.785/0001-58')->numbers())->toBe('13722785000158');

test('Deve retornar o CNPJ quando o metodo __toString for chamado')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect((string) Cnpj::create('13722785000158'))->toBe('13722785000158');

test('Deve retornar o CNPJ quando o metodo jsonSerialize for chamado')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::create('13722785000158')->jsonSerialize())->toBe([
        'type' => 'CNPJ',
        'value' => '13722785000158',
        'mask' => '13.722.785/0001-58',
    ]);

test('Deve retornar o tipo do documento')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::create('13722785000158')->type())->toBe('CNPJ');

test('Deve retornar true quando o CNPJ for matriz')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::create('13722785000158')->isMatrix())->toBeTrue();

test('Deve retornar false quando o CNPJ nao for matriz')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::create('05147748000488')->isMatrix())->toBeFalse();

test('Deve retornar uma instancia de CNPJ com valor aleatorio valido')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::random())->toBeInstanceOf(ICnpj::class)
    ->and(Cnpj::validate(Cnpj::random()->numbers()))->toBeTrue();

test('Deve retornar o prefixo do CNPJ')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::create('13722785000158')->prefixMatrix())->toBe('137227850001');

test('Deve retornar a raiz do CNPJ')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::create('13722785000158')->root())->toBe('13722785');

test('Deve retornar os digitos do CNPJ')
    ->group('Cnpj', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(Cnpj::create('13722785000158')->digits())->toBe('58');
