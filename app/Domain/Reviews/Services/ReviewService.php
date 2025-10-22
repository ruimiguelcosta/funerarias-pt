<?php

namespace App\Domain\Reviews\Services;

use App\Domain\Reviews\Data\ReviewData;
use App\Models\FuneralHome;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class ReviewService
{
    public function store(ReviewData $data): Review
    {
        return DB::transaction(function () use ($data) {
            $review = Review::query()->create([
                'funeral_home_id' => $data->funeral_home_id,
                'rating' => $data->rating,
                'author_name' => $data->author_name,
                'text' => $data->comment,
                'published_at' => now(),
            ]);

            $this->updateFuneralHomeStatistics($data->funeral_home_id);

            return $review;
        });
    }

    private function updateFuneralHomeStatistics(int $funeralHomeId): void
    {
        $funeralHome = FuneralHome::query()->find($funeralHomeId);
        $reviews = Review::query()->where('funeral_home_id', $funeralHomeId)->get();

        $funeralHome->update([
            'reviews_count' => $reviews->count(),
            'total_score' => $reviews->avg('rating'),
        ]);
    }
}
