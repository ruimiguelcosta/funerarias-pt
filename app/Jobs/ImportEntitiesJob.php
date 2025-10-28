<?php

namespace App\Jobs;

use App\Models\Entity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ImportEntitiesJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public array $entitiesData,
        public int $tenantId,
        public int $batchIndex
    ) {}

    public function handle(): void
    {
        $importedCount = 0;
        $updatedCount = 0;
        $errors = [];

        foreach ($this->entitiesData as $index => $entityData) {
            try {
                $existingEntity = Entity::query()
                    ->where('tenant_id', $this->tenantId)
                    ->where(function ($query) use ($entityData) {
                        $query->where('place_id', $entityData['placeId'] ?? null)
                            ->orWhere('title', $entityData['title'] ?? null);
                    })
                    ->first();

                $processedData = $this->processEntityData($entityData);
                $processedData['tenant_id'] = $this->tenantId;

                if ($existingEntity) {
                    $existingEntity->update($processedData);
                    $updatedCount++;
                } else {
                    Entity::query()->create($processedData);
                    $importedCount++;
                }
            } catch (\Exception $e) {
                $errors[] = 'Linha '.($index + 1).': '.$e->getMessage();
                Log::error('Erro ao processar entidade', [
                    'batchIndex' => $this->batchIndex,
                    'index' => $index,
                    'data' => $entityData,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        Log::info('Batch processado', [
            'batchIndex' => $this->batchIndex,
            'imported' => $importedCount,
            'updated' => $updatedCount,
            'errors' => count($errors),
        ]);
    }

    private function processEntityData(array $data): array
    {
        return [
            'title' => $data['title'] ?? null,
            'price' => $data['price'] ?? null,
            'category_name' => $data['categoryName'] ?? null,
            'address' => $data['address'] ?? null,
            'neighborhood' => $data['neighborhood'] ?? null,
            'street' => $data['street'] ?? null,
            'city' => $data['city'] ?? null,
            'postal_code' => $data['postalCode'] ?? null,
            'state' => $data['state'] ?? null,
            'country_code' => $data['countryCode'] ?? null,
            'phone' => $data['phone'] ?? null,
            'phone_unformatted' => $data['phoneUnformatted'] ?? null,
            'website' => $data['website'] ?? null,
            'description' => $data['description'] ?? null,
            'sub_title' => $data['subTitle'] ?? null,
            'located_in' => $data['locatedIn'] ?? null,
            'plus_code' => $data['plusCode'] ?? null,
            'latitude' => $data['location']['lat'] ?? null,
            'longitude' => $data['location']['lng'] ?? null,
            'permanently_closed' => $data['permanentlyClosed'] ?? false,
            'temporarily_closed' => $data['temporarilyClosed'] ?? false,
            'claim_this_business' => $data['claimThisBusiness'] ?? false,
            'place_id' => $data['placeId'] ?? null,
            'fid' => $data['fid'] ?? null,
            'cid' => $data['cid'] ?? null,
            'reviews_count' => $data['reviewsCount'] ?? null,
            'images_count' => $data['imagesCount'] ?? null,
            'total_score' => $data['totalScore'] ?? null,
            'image_url' => $data['imageUrl'] ?? null,
            'kgmid' => $data['kgmid'] ?? null,
            'url' => $data['url'] ?? null,
            'search_page_url' => $data['searchPageUrl'] ?? null,
            'search_string' => $data['searchString'] ?? null,
            'language' => $data['language'] ?? null,
            'rank' => $data['rank'] ?? null,
            'is_advertisement' => $data['isAdvertisement'] ?? false,
            'is_suggested' => $data['is_suggested'] ?? false,
            'is_accepted' => $data['is_accepted'] ?? false,
            'scraped_at' => isset($data['scrapedAt']) ? now() : null,
        ];
    }
}
