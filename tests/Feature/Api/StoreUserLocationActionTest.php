<?php

namespace Tests\Feature\Api;

use App\Models\UserLocation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreUserLocationActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_stores_user_location_successfully(): void
    {
        $locationData = [
            'latitude' => 38.7223,
            'longitude' => -9.1393,
            'accuracy' => 50.5,
        ];

        $response = $this->postJson('/api/user-location', $locationData);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Localização guardada com sucesso',
            ])
            ->assertJsonStructure([
                'success',
                'message',
                'location' => [
                    'id',
                    'latitude',
                    'longitude',
                ],
            ]);

        $this->assertDatabaseHas('user_locations', [
            'latitude' => 38.7223,
            'longitude' => -9.1393,
            'accuracy' => 50.5,
        ]);

        $location = UserLocation::query()->first();
        $this->assertNotNull($location->session_id);
        $this->assertNotNull($location->ip_address);
        $this->assertTrue($location->permission_granted);
    }

    public function test_stores_user_location_without_accuracy(): void
    {
        $locationData = [
            'latitude' => 41.1579,
            'longitude' => -8.6291,
        ];

        $response = $this->postJson('/api/user-location', $locationData);

        $response->assertStatus(201);

        $this->assertDatabaseHas('user_locations', [
            'latitude' => 41.1579,
            'longitude' => -8.6291,
            'accuracy' => null,
        ]);
    }

    public function test_validates_required_latitude(): void
    {
        $locationData = [
            'longitude' => -9.1393,
        ];

        $response = $this->postJson('/api/user-location', $locationData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['latitude']);
    }

    public function test_validates_required_longitude(): void
    {
        $locationData = [
            'latitude' => 38.7223,
        ];

        $response = $this->postJson('/api/user-location', $locationData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['longitude']);
    }

    public function test_validates_latitude_range(): void
    {
        $locationData = [
            'latitude' => 95.0,
            'longitude' => -9.1393,
        ];

        $response = $this->postJson('/api/user-location', $locationData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['latitude']);
    }

    public function test_validates_longitude_range(): void
    {
        $locationData = [
            'latitude' => 38.7223,
            'longitude' => 190.0,
        ];

        $response = $this->postJson('/api/user-location', $locationData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['longitude']);
    }

    public function test_validates_accuracy_must_be_positive(): void
    {
        $locationData = [
            'latitude' => 38.7223,
            'longitude' => -9.1393,
            'accuracy' => -10,
        ];

        $response = $this->postJson('/api/user-location', $locationData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['accuracy']);
    }

    public function test_stores_device_information(): void
    {
        $locationData = [
            'latitude' => 38.7223,
            'longitude' => -9.1393,
        ];

        $this->withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
        ])->postJson('/api/user-location', $locationData);

        $location = UserLocation::query()->first();
        $this->assertNotNull($location->user_agent);
        $this->assertNotNull($location->device);
    }

    public function test_stores_multiple_locations_for_same_session(): void
    {
        $firstLocation = [
            'latitude' => 38.7223,
            'longitude' => -9.1393,
        ];

        $secondLocation = [
            'latitude' => 41.1579,
            'longitude' => -8.6291,
        ];

        $this->postJson('/api/user-location', $firstLocation)->assertStatus(201);
        $this->postJson('/api/user-location', $secondLocation)->assertStatus(201);

        $this->assertDatabaseCount('user_locations', 2);

        $this->assertDatabaseHas('user_locations', [
            'latitude' => 38.7223,
            'longitude' => -9.1393,
        ]);

        $this->assertDatabaseHas('user_locations', [
            'latitude' => 41.1579,
            'longitude' => -8.6291,
        ]);
    }
}
