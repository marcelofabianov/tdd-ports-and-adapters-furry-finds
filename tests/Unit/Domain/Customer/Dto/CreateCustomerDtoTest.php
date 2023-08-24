<?php

declare(strict_types=1);

use FurryFinds\Domain\Core\ValueObjects\CreatedAt;
use FurryFinds\Domain\Core\ValueObjects\Email;
use FurryFinds\Domain\Core\ValueObjects\InactivatedAt;
use FurryFinds\Domain\Core\ValueObjects\RegistrationDocument;
use FurryFinds\Domain\Core\ValueObjects\UpdatedAt;
use FurryFinds\Domain\Core\ValueObjects\Uuid;
use FurryFinds\Domain\Customer\Dto\CreateCustomerDto;

test('Deve criar uma nova instancia de CreateCustomerDto', function () {
    $data = [
        'tenantId' => Uuid::random(),
        'id' => Uuid::random(),
        'createdAt' => CreatedAt::random(),
        'updatedAt' => UpdatedAt::random(),
        'inactivatedAt' => InactivatedAt::random(),
        'registrationDocument' => RegistrationDocument::random(),
        'name' => fake()->name,
        'email' => Email::random(),
        'password' => fake()->password(8),
    ];

    $dto = new CreateCustomerDto(
        tenantId: $data['tenantId'],
        id: $data['id'],
        createdAt: $data['createdAt'],
        updatedAt: $data['updatedAt'],
        inactivatedAt: $data['inactivatedAt'],
        registrationDocument: $data['registrationDocument'],
        name: $data['name'],
        email: $data['email'],
        password: $data['password'],
    );

    $expected = [
        'tenantId' => (string) $data['tenantId'],
        'id' => (string) $data['id'],
        'createdAt' => (string) $data['createdAt'],
        'updatedAt' => (string) $data['updatedAt'],
        'inactivatedAt' => (string) $data['inactivatedAt'],
        'registrationDocument' => (string) $data['registrationDocument'],
        'name' => $data['name'],
        'email' => (string) $data['email'],
        'password' => $data['password'],
    ];

    $actual = [
        'tenantId' => (string) $dto->tenantId,
        'id' => (string) $dto->id,
        'createdAt' => (string) $dto->createdAt,
        'updatedAt' => (string) $dto->updatedAt,
        'inactivatedAt' => (string) $dto->inactivatedAt,
        'registrationDocument' => (string) $dto->registrationDocument,
        'name' => $dto->name,
        'email' => (string) $dto->email,
        'password' => $dto->password,
    ];

    expect($actual)->toEqual($expected);
})
    ->group('Unit', 'Domain', 'Dto', 'Customer', 'CreateCustomerDto');
