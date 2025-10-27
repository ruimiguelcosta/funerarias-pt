<?php

namespace Tests\Feature\Reviews;

use App\Models\Entity;
use Tests\TestCase;

class StoreReviewTest extends TestCase
{
    public function test_stores_a_review_successfully(): void
    {
        $entity = Entity::factory()->create();

        $payload = [
            'entity_id' => $entity->id,
            'rating' => 5,
            'author_name' => 'João Silva',
            'comment' => 'Excelente serviço, muito profissional.',
        ];

        $this->postJson('/reviews', $payload)
            ->assertRedirect();

        $this->assertDatabaseHas('reviews', [
            'entity_id' => $entity->id,
            'rating' => 5,
            'author_name' => 'João Silva',
            'text' => 'Excelente serviço, muito profissional.',
        ]);
    }

    public function test_validates_required_fields_for_review(): void
    {
        $this->postJson('/reviews', [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['entity_id', 'rating', 'author_name', 'comment']);
    }

    public function test_validates_funeral_home_exists(): void
    {
        $payload = [
            'entity_id' => 999,
            'rating' => 5,
            'author_name' => 'João Silva',
            'comment' => 'Excelente serviço.',
        ];

        $this->postJson('/reviews', $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['entity_id']);
    }

    public function test_validates_rating_range(): void
    {
        $entity = Entity::factory()->create();

        $payload = [
            'entity_id' => $entity->id,
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
        $entity = Entity::factory()->create(['reviews_count' => 0, 'total_score' => 0]);

        $payload = [
            'entity_id' => $entity->id,
            'rating' => 4,
            'author_name' => 'João Silva',
            'comment' => 'Bom serviço.',
        ];

        $this->postJson('/reviews', $payload);

        $entity->refresh();
        $this->assertEquals(1, $entity->reviews_count);
        $this->assertEquals(4.0, $entity->total_score);
    }
}
