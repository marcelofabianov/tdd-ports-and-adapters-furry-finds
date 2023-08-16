<?php

declare(strict_types=1);

use FurryFinds\Domain\Core\Entities\ClientCredential;
use FurryFinds\Domain\Core\Enums\CredentialGrantTypeEnum;
use FurryFinds\Domain\Core\Enums\CredentialScopesEnum;
use FurryFinds\Domain\Core\ValueObjects\Uuid;

test('Deve criar uma instancia da entidade', function () {
    $data = [
        'client_id' => Uuid::random(),
        'client_secret' => md5(fake()->word()),
        'scope' => CredentialScopesEnum::CUSTOMERS,
    ];

    $credential = ClientCredential::create(
        $data['client_id'],
        $data['client_secret'],
        $data['scope']
    );

    $toArrayExpected = [
        'grant_type' => CredentialGrantTypeEnum::CLIENT_CREDENTIALS->value,
        'client_id' => $data['client_id']->getValue(),
        'client_secret' => $data['client_secret'],
        'scope' => $data['scope']->value,
    ];

    expect($credential->toArray())->toEqual($toArrayExpected);
})
    ->group('Core', 'Unit', 'Entities', 'ClientCredential', 'Credentials');
