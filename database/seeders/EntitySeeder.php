<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Entity;
use App\Models\Image;
use App\Models\OpeningHour;
use App\Models\PeopleAlsoSearch;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class EntitySeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = storage_path('app/private/json/funerarias_pt.json');

        if (! File::exists($jsonPath)) {
            $this->command->error('JSON file not found at: '.$jsonPath);

            return;
        }

        $data = json_decode(File::get($jsonPath), true);

        if (! $data) {
            $this->command->error('Failed to parse JSON file');

            return;
        }

        $this->command->info('Starting import of '.count($data).' entities...');

        foreach ($data as $index => $item) {
            $this->command->info('Processing entity '.($index + 1).': '.$item['title']);

            $entity = $this->createEntity($item);

            $this->createCategories($entity, $item);
            $this->createOpeningHours($entity, $item);
            $this->createPeopleAlsoSearch($entity, $item);
            $this->createImages($entity, $item);
            $this->createReviews($entity, $item);
        }

        $this->command->info('Import completed successfully!');
    }

    private function createEntity(array $item): Entity
    {
        $entity = Entity::query()
            ->where('title', $item['title'])
            ->where('address', $item['address'] ?? null)
            ->first();

        if ($entity) {
            $this->command->info("Entity already exists: {$item['title']}");

            return $entity;
        }

        return Entity::query()->create([
            'title' => $item['title'],
            'price' => $item['price'] ?? null,
            'category_name' => $item['categoryName'] ?? null,
            'address' => $item['address'] ?? null,
            'neighborhood' => $item['neighborhood'] ?? null,
            'street' => $item['street'] ?? null,
            'city' => $item['city'] ?? null,
            'postal_code' => $item['postalCode'] ?? null,
            'state' => $item['state'] ?? null,
            'country_code' => $item['countryCode'] ?? 'PT',
            'phone' => $item['phone'] ?? null,
            'phone_unformatted' => $item['phoneUnformatted'] ?? null,
            'website' => $item['website'] ?? null,
            'description' => $item['description'] ?? null,
            'sub_title' => $item['subTitle'] ?? null,
            'located_in' => $item['locatedIn'] ?? null,
            'plus_code' => $item['plusCode'] ?? null,
            'latitude' => $item['location']['lat'] ?? null,
            'longitude' => $item['location']['lng'] ?? null,
            'permanently_closed' => $item['permanentlyClosed'] ?? false,
            'temporarily_closed' => $item['temporarilyClosed'] ?? false,
            'claim_this_business' => $item['claimThisBusiness'] ?? false,
            'place_id' => $item['placeId'] ?? null,
            'fid' => $item['fid'] ?? null,
            'cid' => $item['cid'] ?? null,
            'reviews_count' => $item['reviewsCount'] ?? 0,
            'images_count' => $item['imagesCount'] ?? 0,
            'total_score' => $item['totalScore'] ?? null,
            'image_url' => $item['imageUrl'] ?? null,
            'kgmid' => $item['kgmid'] ?? null,
            'url' => $item['url'] ?? null,
            'search_page_url' => $item['searchPageUrl'] ?? null,
            'search_string' => $item['searchString'] ?? null,
            'language' => $item['language'] ?? 'pt-PT',
            'rank' => $item['rank'] ?? null,
            'is_advertisement' => $item['isAdvertisement'] ?? false,
            'scraped_at' => isset($item['scrapedAt']) ? now()->parse($item['scrapedAt']) : null,
        ]);
    }

    private function createCategories(Entity $entity, array $item): void
    {
        if (isset($item['categories']) && is_array($item['categories'])) {
            foreach ($item['categories'] as $categoryName) {
                $category = Category::query()->firstOrCreate(
                    ['name' => $categoryName],
                    ['description' => null, 'is_active' => true]
                );

                $entity->categories()->syncWithoutDetaching([$category->id]);
            }
        }
    }

    private function createOpeningHours(Entity $entity, array $item): void
    {
        if (isset($item['openingHours']) && is_array($item['openingHours'])) {
            foreach ($item['openingHours'] as $openingHour) {
                OpeningHour::query()->firstOrCreate([
                    'entity_id' => $entity->id,
                    'day' => $openingHour['day'],
                ], [
                    'hours' => $openingHour['hours'],
                ]);
            }
        }
    }

    private function createPeopleAlsoSearch(Entity $entity, array $item): void
    {
        if (isset($item['peopleAlsoSearch']) && is_array($item['peopleAlsoSearch'])) {
            foreach ($item['peopleAlsoSearch'] as $search) {
                PeopleAlsoSearch::query()->firstOrCreate([
                    'entity_id' => $entity->id,
                    'title' => $search['title'],
                ], [
                    'category' => $search['category'],
                    'reviews_count' => $search['reviewsCount'] ?? 0,
                    'total_score' => $search['totalScore'] ?? null,
                ]);
            }
        }
    }

    private function createImages(Entity $entity, array $item): void
    {
        if (isset($item['imageUrl']) && $item['imageUrl']) {
            Image::query()->firstOrCreate([
                'entity_id' => $entity->id,
                'original_url' => $item['imageUrl'],
            ], [
                'category' => 'main',
            ]);
        }

        if (isset($item['imageUrls']) && is_array($item['imageUrls'])) {
            foreach ($item['imageUrls'] as $imageUrl) {
                Image::query()->firstOrCreate([
                    'entity_id' => $entity->id,
                    'original_url' => $imageUrl,
                ], [
                    'category' => 'gallery',
                ]);
            }
        }
    }

    private function createReviews(Entity $entity, array $item): void
    {
        if (isset($item['reviews']) && is_array($item['reviews'])) {
            foreach ($item['reviews'] as $review) {
                Review::query()->firstOrCreate([
                    'entity_id' => $entity->id,
                    'review_id' => $review['reviewId'] ?? null,
                ], [
                    'author_name' => $review['authorName'] ?? null,
                    'author_photo_url' => $review['authorPhotoUrl'] ?? null,
                    'rating' => $review['rating'] ?? null,
                    'text' => $review['text'] ?? null,
                    'published_at' => isset($review['publishedAt']) ? now()->parse($review['publishedAt']) : null,
                ]);
            }
        }
    }
}

