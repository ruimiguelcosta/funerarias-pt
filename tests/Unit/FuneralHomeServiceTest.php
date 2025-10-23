<?php

namespace Tests\Unit;

use App\Domain\FuneralHomes\Services\FuneralHomeService;
use App\Models\FuneralHome;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class FuneralHomeServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function test_get_featured_funeral_homes_uses_cache(): void
    {
        Cache::flush();

        FuneralHome::factory()->count(5)->create([
            'city_slug' => 'lisboa',
        ]);

        $service = new FuneralHomeService;

        $result1 = $service->getFeaturedFuneralHomes(3);
        $result2 = $service->getFeaturedFuneralHomes(3);

        $this->assertCount(3, $result1);
        $this->assertCount(3, $result2);
        $this->assertTrue(Cache::has('featured_funeral_homes'));
    }

    public function test_get_featured_funeral_homes_cache_expires_after_24_hours(): void
    {
        Cache::flush();

        FuneralHome::factory()->count(5)->create([
            'city_slug' => 'lisboa',
        ]);

        $service = new FuneralHomeService;

        $service->getFeaturedFuneralHomes(3);

        $this->assertTrue(Cache::has('featured_funeral_homes'));

        Cache::put('featured_funeral_homes', 'test', 0);

        $this->assertFalse(Cache::has('featured_funeral_homes'));
    }

    public function test_get_featured_funeral_homes_returns_correct_structure(): void
    {
        Cache::flush();

        FuneralHome::factory()->count(3)->create([
            'city_slug' => 'lisboa',
        ]);

        $service = new FuneralHomeService;
        $result = $service->getFeaturedFuneralHomes(3);

        $this->assertCount(3, $result);

        foreach ($result as $funeralHome) {
            $this->assertNotNull($funeralHome->city_slug);
            $this->assertTrue($funeralHome->relationLoaded('images'));
            $this->assertTrue($funeralHome->relationLoaded('categories'));
        }
    }
}
