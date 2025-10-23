<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostIdea>
 */
class PostIdeaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Guias e Informação Prática',
            'Serviços e Processos',
            'Apoio Emocional e Luto',
            'Sustentabilidade e Inovação',
            'Tradições, Cultura e História',
            'Conteúdo Local e Comparativo',
        ];

        return [
            'title' => fake()->sentence(8),
            'description' => fake()->paragraph(),
            'meta_title' => fake()->sentence(6),
            'meta_description' => fake()->sentence(12),
            'category' => fake()->randomElement($categories),
            'status' => fake()->randomElement(['waiting', 'processed']),
            'image' => null,
            'is_used' => false,
            'used_at' => null,
        ];
    }

    public function used(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_used' => true,
            'used_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ]);
    }

    public function unused(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_used' => false,
            'used_at' => null,
        ]);
    }

    public function waiting(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'waiting',
        ]);
    }

    public function processed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'processed',
        ]);
    }
}
