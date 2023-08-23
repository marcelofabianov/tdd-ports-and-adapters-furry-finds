<?php

declare(strict_types=1);

use FurryFinds\Domain\Core\Exceptions\FurryDomainCoreException;
use FurryFinds\Domain\Core\Interfaces\ValueObjects\IRegistrationDocument;
use FurryFinds\Domain\Core\ValueObjects\RegistrationDocument;

test('Deve retornar false quando passado int zero como Cnpj')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::validate(0))->toBeFalse();

test('Deve retornar false quando passado string zero como Cnpj')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::validate('0'))->toBeFalse();

test('Deve retornar false quando passado string vazia como Cnpj')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::validate(''))->toBeFalse();

test('Deve retornar false quando passado int caracteres iguais')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::validate(11111111111111))->toBeFalse();

test('Deve retornar false quando passado string caracteres iguais')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::validate('11111111111111'))->toBeFalse();

test('Deve retornar false quando passado string de caracteres sequenciais de 0 a 11')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::validate('01234567891011'))->toBeFalse();

test('Deve retornar false quando passado int de caracteres sequenciais de 1 a 12')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::validate(123456789101112))->toBeFalse();

test('Deve retornar false quando passado string de caracteres sequenciais 1 a 10')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::validate('123456789101112'))->toBeFalse();

test('Deve retornar true quando passado um CNPJ valido como inteiro')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::validate(13722785000158))->toBeTrue();

test('Deve retornar true quando validacao do CNPJ for valida')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::validate('13722785000158'))->toBeTrue();

test('Deve retornar false quando validacao do CNPJ for invalida')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::validate('13722785000159'))->toBeFalse();

test('Deve retornar true quando passado um CNPJ com mascara')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::validate('13.722.785/0001-58'))->toBeTrue();

test('Deve retornar true quando o CNPJ for matriz')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::create('13722785000158')->isMatrix())->toBeTrue();

test('Deve retornar false quando o CNPJ nao for matriz')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::create('05147748000488')->isMatrix())->toBeFalse();

test('Deve criar uma nova instancia quando o CNPJ passado for valido')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::create('13722785000158'))->toBeInstanceOf(IRegistrationDocument::class);

test('Deve criar uma nova instancia quando o CNPJ passado com mascara for valido')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::create('13.722.785/0001-58'))->toBeInstanceOf(IRegistrationDocument::class);

test('Deve lancar uma excecao quando o CNPJ passado com mascara for invalido')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->throws(FurryDomainCoreException::class)
    ->expect(fn () => RegistrationDocument::create('13.722.785/0001-59'));

test('Deve lancar uma excecao quando o CNPJ passado for invalido')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->throws(FurryDomainCoreException::class)
    ->expect(fn () => RegistrationDocument::create('13722785000159'));

test('Deve retornar uma instancia de CNPJ com valor aleatorio valido')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::random())->toBeInstanceOf(IRegistrationDocument::class)
    ->and(RegistrationDocument::validate(RegistrationDocument::random()->numbers()))->toBeTrue();

test('Deve retornar o CNPJ formatado')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::create('13722785000158')->mask())->toBe('13.722.785/0001-58');

test('Deve retornar o CNPJ sem formatacao somente numeros')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::create('13.722.785/0001-58')->numbers())->toBe('13722785000158');

test('Deve retornar o CNPJ quando o metodo __toString for chamado')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect((string) RegistrationDocument::create('13722785000158'))->toBe('13722785000158');

test('Deve retornar o CNPJ quando o metodo jsonSerialize for chamado')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::create('13722785000158')->jsonSerialize())->toBe([
        'type' => 'CNPJ',
        'value' => '13722785000158',
        'mask' => '13.722.785/0001-58',
    ]);

test('Deve retornar o tipo do documento')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::create('13722785000158')->type())->toBe('CNPJ');

test('Deve retornar o prefixo do CNPJ')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::create('13722785000158')->prefixMatrix())->toBe('137227850001');

test('Deve retornar a raiz do CNPJ')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::create('13722785000158')->root())->toBe('13722785');

test('Deve retornar os digitos do CNPJ')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::create('13722785000158')->digits())->toBe('58');

test('Deve retonar true quando passado um CPF valido como inteiro')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::validate(78226510058))->toBeTrue();

test('Deve retornar true quando validacao do CPF for valida')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::validate('64014695018'))->toBeTrue();

test('Deve retornar false quando validacao do CPF for invalida')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::validate('64014695019'))->toBeFalse();

test('Deve retornar true quando passado um CPF com mascara')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::validate('640.146.950-18'))->toBeTrue();

test('Deve retornar true quando o CPF for verificado como matriz')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::create('784.060.760-89')->isMatrix())->toBeTrue();

test('Deve retornar o CPF quando solicitado prefixo matriz')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::create('784.060.760-89')->prefixMatrix())->toBe('78406076089');

test('Deve criar uma nova instancia quando o CPF passado for valido')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::create('03303340005'))->toBeInstanceOf(IRegistrationDocument::class);

test('Deve criar uma nova instancia quando o CPF passado com mascara for valido')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::create('033.033.400-05'))->toBeInstanceOf(IRegistrationDocument::class);

test('Deve lancar uma excecao quando o CPF passado com mascara for invalido')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->throws(FurryDomainCoreException::class)
    ->expect(fn () => RegistrationDocument::create('033.033.400-06'));

test('Deve lancar uma excecao quando o CPF passado for invalido')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->throws(FurryDomainCoreException::class)
    ->expect(fn () => RegistrationDocument::create('03303340006'));

test('Deve retornar uma instancia de CPF com valor aleatorio valido')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::random())->toBeInstanceOf(IRegistrationDocument::class)
    ->and(RegistrationDocument::validate(RegistrationDocument::random()->numbers()))->toBeTrue();

test('Deve retornar o CPF formatado')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::create('78406076089')->mask())->toBe('784.060.760-89');

test('Deve retornar o CPF sem formatacao somente numeros')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::create('784.060.760-89')->numbers())->toBe('78406076089');

test('Deve retornar o CPF quando o metodo __toString for chamado')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect((string) RegistrationDocument::create('784.060.760-89'))->toBe('78406076089');

test('Deve retornar o CPF quando o metodo jsonSerialize for chamado')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::create('784.060.760-89')->jsonSerialize())->toBe([
        'type' => 'CPF',
        'value' => '78406076089',
        'mask' => '784.060.760-89',
    ]);

test('Deve retornar o tipo do documento CPF')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::create('784.060.760-89')->type())->toBe('CPF');

test('Deve retornar o CPF quando solicitado a raiz do documento')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::create('784.060.760-89')->root())->toBe('784060760');

test('Deve retornar os digitos verificadores do CPF')
    ->group('RegistrationDocument', 'ValueObject', 'Domain', 'Core', 'Unit')
    ->expect(RegistrationDocument::create('784.060.760-89')->digits())->toBe('89');
