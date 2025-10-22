<?php

namespace Tests\Feature\Reviews;

use App\Models\FuneralHome;
use Tests\TestCase;

class StoreReviewTest extends TestCase
{
    public function test_stores_a_review_successfully(): void
    {
        $funeralHome = FuneralHome::factory()->create();

        $payload = [
            'funeral_home_id' => $funeralHome->id,
            'rating' => 5,
            'author_name' => 'João Silva',
            'comment' => 'Excelente serviço, muito profissional.',
        ];

        $this->postJson('/reviews', $payload)
            ->assertRedirect();

        $this->assertDatabaseHas('reviews', [
            'funeral_home_id' => $funeralHome->id,
            'rating' => 5,
            'author_name' => 'João Silva',
            'text' => 'Excelente serviço, muito profissional.',
        ]);
    }

    public function test_validates_required_fields_for_review(): void
    {
        $this->postJson('/reviews', [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['funeral_home_id', 'rating', 'author_name', 'comment']);
    }

    public function test_validates_funeral_home_exists(): void
    {
        $payload = [
            'funeral_home_id' => 999,
            'rating' => 5,
            'author_name' => 'João Silva',
            'comment' => 'Excelente serviço.',
        ];

        $this->postJson('/reviews', $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['funeral_home_id']);
    }

    public function test_validates_rating_range(): void
    {
        $funeralHome = FuneralHome::factory()->create();

        $payload = [
            'funeral_home_id' => $funeralHome->id,
            'rating' => 6,
            'author_name' => 'João Silva',
            'comment' => 'Excelente serviço.',
        ];

        $this->postJson('/reviews', $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['rating']);
    }

    public function test_updates_funeral_home_statistics_after_review(): void
    {
        $funeralHome = FuneralHome::factory()->create(['reviews_count' => 0, 'total_score' => 0]);

        $payload = [
            'funeral_home_id' => $funeralHome->id,
            'rating' => 4,
            'author_name' => 'João Silva',
            'comment' => 'Bom serviço.',
        ];

        $this->postJson('/reviews', $payload);

        $funeralHome->refresh();
        $this->assertEquals(1, $funeralHome->reviews_count);
        $this->assertEquals(4.0, $funeralHome->total_score);
    }
}
