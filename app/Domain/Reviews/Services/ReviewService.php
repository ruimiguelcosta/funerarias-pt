<?php

namespace App\Domain\Reviews\Services;

use App\Domain\Reviews\Data\ReviewData;
use App\Models\Entity;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class ReviewService
{
    public function store(ReviewData $data): Review
    {
        return DB::transaction(function () use ($data) {
            $review = Review::query()->create([
                'entity_id' => $data->entity_id,
                'rating' => $data->rating,
                'author_name' => $data->author_name,
                'text' => $data->comment,
                'published_at' => now(),
            ]);

            $this->updateEntityStatistics($data->entity_id);

            return $review;
        });
    }

    private function updateEntityStatistics(int $funeralHomeId): void
    {
        $funeralHome = Entity::query()->find($funeralHomeId);
        $reviews = Review::query()->where('entity_id', $funeralHomeId)->get();

        $funeralHome->update([
            'reviews_count' => $reviews->count(),
            'total_score' => $reviews->avg('rating'),
        ]);
    }
}
