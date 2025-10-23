<?php

namespace Tests\Feature;

use App\Models\FuneralHome;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetMapFuneralHomesActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_nearby_funeral_homes_within50_km(): void
    {
        $userLatitude = 41.1496100;
        $userLongitude = -8.6109900;

        $nearbyHome = FuneralHome::factory()->create([
            'title' => 'Funerária Próxima',
            'latitude' => 41.1500000,
            'longitude' => -8.6100000,
            'city' => 'Porto',
            'city_slug' => 'porto',
        ]);

        $response = $this->getJson("/api/map-funeral-homes?latitude={$userLatitude}&longitude={$userLongitude}");

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
                        'phone',
                        'latitude',
                        'longitude',
                        'distance',
                        'url',
                        'image',
                    ],
                ],
            ])
            ->assertJsonPath('success', true);

        $funeralHomes = $response->json('funeral_homes');

        $this->assertIsArray($funeralHomes);
        $this->assertGreaterThan(0, count($funeralHomes));

        $this->assertEquals($nearbyHome->id, $funeralHomes[0]['id']);
        $this->assertIsFloat($funeralHomes[0]['latitude']);
        $this->assertIsFloat($funeralHomes[0]['longitude']);
    }

    public function test_returns_correct_coordinates_format(): void
    {
        $userLatitude = 41.1496100;
        $userLongitude = -8.6109900;

        FuneralHome::factory()->create([
            'latitude' => 41.1500000,
            'longitude' => -8.6100000,
            'city' => 'Porto',
            'city_slug' => 'porto',
        ]);

        $response = $this->getJson("/api/map-funeral-homes?latitude={$userLatitude}&longitude={$userLongitude}");

        $response->assertStatus(200);

        $funeralHomes = $response->json('funeral_homes');

        $this->assertArrayHasKey('latitude', $funeralHomes[0]);
        $this->assertArrayHasKey('longitude', $funeralHomes[0]);
        $this->assertIsNumeric($funeralHomes[0]['latitude']);
        $this->assertIsNumeric($funeralHomes[0]['longitude']);
    }

    public function test_validates_required_parameters(): void
    {
        $response = $this->getJson('/api/map-funeral-homes');

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['latitude', 'longitude']);
    }
}
