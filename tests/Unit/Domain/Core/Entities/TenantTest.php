<?php

declare(strict_types=1);

use FurryFinds\Domain\Core\Entities\Tenant;
use FurryFinds\Domain\Core\Enums\TenantContextEnum;
use FurryFinds\Domain\Core\Interfaces\Entities\ITenant;
use FurryFinds\Domain\Core\ValueObjects\CreatedAt;
use FurryFinds\Domain\Core\ValueObjects\InactivatedAt;
use FurryFinds\Domain\Core\ValueObjects\UpdatedAt;
use FurryFinds\Domain\Core\ValueObjects\Uuid;

test('Deve criar uma nova instancia da entidade Tenant', function () {
    $data = [
        'id' => Uuid::random(),
        'createdAt' => CreatedAt::random(),
        'updatedAt' => UpdatedAt::random(),
        'inactivatedAt' => InactivatedAt::random(),
        'context' => TenantContextEnum::CUSTOMER,
    ];

    $tenant = Tenant::create(
        $data['id'],
        $data['createdAt'],
        $data['updatedAt'],
        $data['inactivatedAt'],
        $data['context']
    );

    $toArrayExpected = [
        'id' => $data['id']->getValue(),
        'created_at' => (string) $data['createdAt'],
        'updated_at' => (string) $data['updatedAt'],
        'inactivated_at' => (string) $data['inactivatedAt'],
        'context' => $data['context']->value,
    ];

    expect($tenant)->toBeInstanceOf(ITenant::class)
        ->and($tenant->toArray())->toEqual($toArrayExpected);
})
    ->group('Unit', 'Domain', 'Core', 'Entities', 'Tenant');
