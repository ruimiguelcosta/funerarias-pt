<?php

namespace Tests\Unit;

use App\Domain\FuneralHomes\Services\EntityService;
use App\Models\Entity;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class EntityServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function test_get_featured_funeral_homes_uses_cache(): void
    {
        Cache::flush();

        Entity::factory()->count(5)->create([
            'city_slug' => 'lisboa',
        ]);

        $service = new EntityService;

        $result1 = $service->getFeaturedEntitys(3);
        $result2 = $service->getFeaturedEntitys(3);

        $this->assertCount(3, $result1);
        $this->assertCount(3, $result2);
        $this->assertTrue(Cache::has('featured_funeral_homes'));
    }

    public function test_get_featured_funeral_homes_cache_expires_after_24_hours(): void
    {
        Cache::flush();

        Entity::factory()->count(5)->create([
            'city_slug' => 'lisboa',
        ]);

        $service = new EntityService;

        $service->getFeaturedEntitys(3);

        $this->assertTrue(Cache::has('featured_funeral_homes'));

        Cache::put('featured_funeral_homes', 'test', 0);

        $this->assertFalse(Cache::has('featured_funeral_homes'));
    }

    public function test_get_featured_funeral_homes_returns_correct_structure(): void
    {
        Cache::flush();

        Entity::factory()->count(3)->create([
            'city_slug' => 'lisboa',
        ]);

        $service = new EntityService;
        $result = $service->getFeaturedEntitys(3);

        $this->assertCount(3, $result);

        foreach ($result as $entity) {
            $this->assertNotNull($entity->city_slug);
            $this->assertTrue($entity->relationLoaded('images'));
            $this->assertTrue($entity->relationLoaded('categories'));
        }
    }
}
