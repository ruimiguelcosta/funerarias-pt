<?php

namespace Tests\Feature;

use App\Models\Entity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetNearbyEntitiesActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_nearby_funeral_homes_within30_km(): void
    {
        $userLatitude = 41.1496100;
        $userLongitude = -8.6109900;

        $nearbyHome = Entity::factory()->create([
            'title' => 'Funerária Próxima',
            'latitude' => 41.1500000,
            'longitude' => -8.6100000,
            'city' => 'Porto',
            'city_slug' => 'porto',
        ]);

        $farHome = Entity::factory()->create([
            'title' => 'Funerária Distante',
            'latitude' => 38.7223000,
            'longitude' => -9.1393000,
            'city' => 'Lisboa',
            'city_slug' => 'lisboa',
        ]);

        $response = $this->getJson("/api/nearby-funeral-homes?latitude={$userLatitude}&longitude={$userLongitude}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'count',
                'funeral_homes' => [
                    '*' => [
                        'id',
                        'title',
                        'slug',
                        'city',
                        'city_slug',
                        'distance',
                        'url',
                        'image',
                        'categories',
                    ],
                ],
            ])
            ->assertJsonPath('success', true);

        $entitys = $response->json('funeral_homes');

        $this->assertIsArray($entitys);
        $this->assertGreaterThan(0, count($entitys));

        $ids = collect($entitys)->pluck('id')->toArray();
        $this->assertContains($nearbyHome->id, $ids);
        $this->assertNotContains($farHome->id, $ids);
    }

    public function test_validates_required_latitude_and_longitude_parameters(): void
    {
        $response = $this->getJson('/api/nearby-funeral-homes');

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['latitude', 'longitude']);
    }

    public function test_validates_latitude_range(): void
    {
        $response = $this->getJson('/api/nearby-funeral-homes?latitude=100&longitude=-8.6109900');

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['latitude']);
    }

    public function test_validates_longitude_range(): void
    {
        $response = $this->getJson('/api/nearby-funeral-homes?latitude=41.1496100&longitude=200');

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['longitude']);
    }

    public function test_returns_empty_array_when_no_funeral_homes_nearby(): void
    {
        $userLatitude = 41.1496100;
        $userLongitude = -8.6109900;

        Entity::factory()->create([
            'latitude' => 38.7223000,
            'longitude' => -9.1393000,
            'city' => 'Lisboa',
            'city_slug' => 'lisboa',
        ]);

        $response = $this->getJson("/api/nearby-funeral-homes?latitude={$userLatitude}&longitude={$userLongitude}");

        $response->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonPath('count', 0);
    }

    public function test_sorts_funeral_homes_by_distance(): void
    {
        $userLatitude = 41.1496100;
        $userLongitude = -8.6109900;

        $closer = Entity::factory()->create([
            'title' => 'Mais Próxima',
            'latitude' => 41.1500000,
            'longitude' => -8.6100000,
            'city' => 'Porto',
            'city_slug' => 'porto',
        ]);

        $farther = Entity::factory()->create([
            'title' => 'Mais Distante',
            'latitude' => 41.1600000,
            'longitude' => -8.6200000,
            'city' => 'Porto',
            'city_slug' => 'porto',
        ]);

        $response = $this->getJson("/api/nearby-funeral-homes?latitude={$userLatitude}&longitude={$userLongitude}");

        $response->assertStatus(200);

        $entitys = $response->json('funeral_homes');

        $this->assertEquals($closer->id, $entitys[0]['id']);
        $this->assertLessThan($entitys[1]['distance'], $entitys[0]['distance']);
    }
}
