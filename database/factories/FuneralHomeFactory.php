<?php

namespace Database\Factories;

use App\Models\FuneralHome;
use Illuminate\Database\Eloquent\Factories\Factory;

class FuneralHomeFactory extends Factory
{
    protected $model = FuneralHome::class;

    public function definition(): array
    {
        $city = fake()->city();
        $citySlug = str($city)->slug();
        $title = fake()->company().' - Serviços Funerários';
        $slug = str($title)->slug();

        return [
            'title' => $title,
            'slug' => $slug,
            'price' => fake()->randomElement(['€€', '€€€', '€€€€']),
            'category_name' => fake()->randomElement(['Funerária', 'Serviços Funerários', 'Crematório']),
            'address' => fake()->address(),
            'neighborhood' => fake()->streetName(),
            'street' => fake()->streetAddress(),
            'city' => $city,
            'city_slug' => $citySlug,
            'postal_code' => fake()->postcode(),
            'state' => fake()->state(),
            'country_code' => 'PT',
            'phone' => fake()->phoneNumber(),
            'phone_unformatted' => fake()->numerify('##########'),
            'website' => fake()->url(),
            'description' => fake()->paragraph(3),
            'generated_description' => fake()->paragraph(2),
            'description_generated_at' => now(),
            'sub_title' => fake()->sentence(3),
            'located_in' => fake()->city(),
            'plus_code' => fake()->regexify('[A-Z0-9]{6}\+[A-Z0-9]{2}'),
            'latitude' => fake()->latitude(36.0, 42.0),
            'longitude' => fake()->longitude(-9.5, -6.0),
            'permanently_closed' => false,
            'temporarily_closed' => false,
            'claim_this_business' => false,
            'place_id' => 'ChIJ'.fake()->regexify('[A-Za-z0-9]{27}'),
            'fid' => fake()->regexify('[A-Za-z0-9]{20}'),
            'cid' => fake()->regexify('[A-Za-z0-9]{20}'),
            'reviews_count' => fake()->numberBetween(0, 50),
            'images_count' => fake()->numberBetween(0, 10),
            'total_score' => fake()->randomFloat(1, 1.0, 5.0),
            'image_url' => fake()->imageUrl(400, 300, 'business'),
            'kgmid' => fake()->regexify('[A-Za-z0-9]{20}'),
            'url' => fake()->url(),
            'search_page_url' => fake()->url(),
            'search_string' => fake()->words(3, true),
            'language' => 'pt',
            'rank' => fake()->numberBetween(1, 100),
            'is_advertisement' => false,
            'scraped_at' => now(),
            'is_suggested' => false,
            'is_accepted' => true,
        ];
    }
}
