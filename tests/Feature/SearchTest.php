<?php

use App\Models\Entity;
use App\Models\Tenant;

it('filtra resultados de pesquisa por tenant e pagina', function () {
    $tenantA = Tenant::factory()->create();
    $tenantB = Tenant::factory()->create();

    config()->set('app.current_tenant_id', $tenantA->id);

    $matchA1 = Entity::factory()->create([
        'tenant_id' => $tenantA->id,
        'title' => 'Funerária Central Porto',
        'address' => 'Rua das Flores, Porto',
        'city_slug' => 'porto',
    ]);

    $matchA2 = Entity::factory()->create([
        'tenant_id' => $tenantA->id,
        'description' => 'Atendimento funeral completo e digno',
        'city_slug' => 'porto',
    ]);

    $otherTenant = Entity::factory()->create([
        'tenant_id' => $tenantB->id,
        'title' => 'Funerária Central Porto',
        'city_slug' => 'porto',
    ]);

    $this->get(route('search.results', ['q' => 'Porto']))
        ->assertOk()
        ->assertSee('Resultados')
        ->assertSee($matchA1->title)
        ->assertDontSee($otherTenant->title);
});


