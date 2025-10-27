<?php

namespace Tests\Feature;

use App\Models\Entity;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class EntityTenantFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_shows_only_entities_from_current_tenant(): void
    {
        $tenant1 = Tenant::factory()->create([
            'domain' => 'http://funerarias.test',
            'name' => 'Funerarias Portugal',
            'is_enabled' => true,
        ]);

        $tenant2 = Tenant::factory()->create([
            'domain' => 'http://outro-tenant.test',
            'name' => 'Outro Tenant',
            'is_enabled' => true,
        ]);

        $entitiesTenant1 = Entity::factory()->count(5)->create([
            'tenant_id' => $tenant1->id,
            'city_slug' => 'lisboa',
        ]);

        $entitiesTenant2 = Entity::factory()->count(3)->create([
            'tenant_id' => $tenant2->id,
            'city_slug' => 'porto',
        ]);

        $response = $this->get('http://funerarias.test/');

        $response->assertOk();

        $viewData = $response->viewData('featuredEntities');

        $this->assertNotEmpty($viewData);

        foreach ($viewData as $entity) {
            $this->assertEquals($tenant1->id, $entity->tenant_id);
        }

        $tenant2Ids = $entitiesTenant2->pluck('id')->toArray();
        foreach ($viewData as $entity) {
            $this->assertNotContains($entity->id, $tenant2Ids);
        }
    }

    public function test_funeral_homes_page_shows_only_entities_from_current_tenant(): void
    {
        $tenant1 = Tenant::factory()->create([
            'domain' => 'http://funerarias.test',
            'name' => 'Funerarias Portugal',
            'is_enabled' => true,
        ]);

        $tenant2 = Tenant::factory()->create([
            'domain' => 'http://outro-tenant.test',
            'name' => 'Outro Tenant',
            'is_enabled' => true,
        ]);

        Entity::factory()->count(8)->create([
            'tenant_id' => $tenant1->id,
            'city_slug' => 'lisboa',
        ]);

        Entity::factory()->count(5)->create([
            'tenant_id' => $tenant2->id,
            'city_slug' => 'porto',
        ]);

        $response = $this->get('http://funerarias.test/funerarias');

        $response->assertOk();

        $entities = $response->viewData('entities');

        $this->assertEquals(8, $entities->total());

        foreach ($entities as $entity) {
            $this->assertEquals($tenant1->id, $entity->tenant_id);
        }
    }

    public function test_cache_is_isolated_per_tenant(): void
    {
        Cache::flush();

        $tenant1 = Tenant::factory()->create([
            'domain' => 'http://funerarias.test',
            'name' => 'Funerarias Portugal',
            'is_enabled' => true,
        ]);

        $tenant2 = Tenant::factory()->create([
            'domain' => 'http://outro-tenant.test',
            'name' => 'Outro Tenant',
            'is_enabled' => true,
        ]);

        Entity::factory()->count(9)->create([
            'tenant_id' => $tenant1->id,
            'city_slug' => 'lisboa',
            'title' => 'Funeraria Lisboa',
        ]);

        Entity::factory()->count(9)->create([
            'tenant_id' => $tenant2->id,
            'city_slug' => 'porto',
            'title' => 'Funeraria Porto',
        ]);

        $responseTenant1 = $this->get('http://funerarias.test/');
        $entitiesTenant1 = $responseTenant1->viewData('featuredEntities');

        $responseTenant2 = $this->get('http://outro-tenant.test/');
        $entitiesTenant2 = $responseTenant2->viewData('featuredEntities');

        $this->assertNotEmpty($entitiesTenant1);
        $this->assertNotEmpty($entitiesTenant2);

        foreach ($entitiesTenant1 as $entity) {
            $this->assertStringContainsString('Lisboa', $entity->title);
        }

        foreach ($entitiesTenant2 as $entity) {
            $this->assertStringContainsString('Porto', $entity->title);
        }

        $this->assertTrue(Cache::has("featured_entities_tenant_{$tenant1->id}"));
        $this->assertTrue(Cache::has("featured_entities_tenant_{$tenant2->id}"));
    }

    public function test_different_tenants_cannot_see_each_others_entities(): void
    {
        $tenant1 = Tenant::factory()->create([
            'domain' => 'http://funerarias.test',
            'is_enabled' => true,
        ]);

        $tenant2 = Tenant::factory()->create([
            'domain' => 'http://outro-tenant.test',
            'is_enabled' => true,
        ]);

        $entityTenant1 = Entity::factory()->create([
            'tenant_id' => $tenant1->id,
            'city_slug' => 'lisboa',
            'slug' => 'funeraria-teste-lisboa',
        ]);

        $entityTenant2 = Entity::factory()->create([
            'tenant_id' => $tenant2->id,
            'city_slug' => 'lisboa',
            'slug' => 'funeraria-teste-porto',
        ]);

        $response = $this->get('http://funerarias.test/lisboa/funeraria-teste-porto');

        $response->assertNotFound();

        $response = $this->get('http://funerarias.test/lisboa/funeraria-teste-lisboa');

        $response->assertOk();
    }
}
