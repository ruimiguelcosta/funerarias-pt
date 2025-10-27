<?php

namespace Tests\Feature;

use App\Models\Entity;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class HomePageActionTest extends TestCase
{
    use DatabaseTransactions;

    public function test_homepage_loads_with_cached_funeral_homes(): void
    {
        Cache::flush();

        Entity::factory()->count(5)->create([
            'city_slug' => 'lisboa',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('pages.home');
        $response->assertViewHas('featuredEntitys');

        $this->assertTrue(Cache::has('featured_funeral_homes'));
    }

    public function test_homepage_uses_cached_data_on_subsequent_requests(): void
    {
        Cache::flush();

        Entity::factory()->count(3)->create([
            'city_slug' => 'porto',
        ]);

        $response1 = $this->get('/');
        $response1->assertStatus(200);

        $response2 = $this->get('/');
        $response2->assertStatus(200);

        $this->assertTrue(Cache::has('featured_funeral_homes'));
    }
}
