<?php

namespace App\Domain\PostIdeas\Services;

use App\Domain\PostIdeas\Data\PostIdeaData;
use App\Models\PostIdea;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PostIdeaService
{
    public function store(PostIdeaData $data): PostIdea
    {
        return DB::transaction(function () use ($data) {
            return PostIdea::query()->create($data->toArray());
        });
    }

    public function update(PostIdea $postIdea, PostIdeaData $data): PostIdea
    {
        return DB::transaction(function () use ($postIdea, $data) {
            $postIdea->fill($data->toArray())->save();

            return $postIdea;
        });
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return PostIdea::query()->latest()->paginate($perPage);
    }

    public function getUnusedIdeas(): \Illuminate\Database\Eloquent\Collection
    {
        return PostIdea::query()->unused()->get();
    }

    public function getRandomUnusedIdea(): ?PostIdea
    {
        return PostIdea::query()->unused()->inRandomOrder()->first();
    }

    public function markAsUsed(PostIdea $postIdea): PostIdea
    {
        $postIdea->markAsUsed();

        return $postIdea;
    }

    public function getByCategory(string $category): \Illuminate\Database\Eloquent\Collection
    {
        return PostIdea::query()->byCategory($category)->get();
    }

    public function getPublishedPosts(int $perPage = 12): LengthAwarePaginator
    {
        return PostIdea::query()
            ->where('is_used', true)
            ->whereNotNull('description')
            ->latest('used_at')
            ->paginate($perPage);
    }

    public function getFeaturedPosts(int $limit = 3): \Illuminate\Database\Eloquent\Collection
    {
        return PostIdea::query()
            ->where('is_used', true)
            ->whereNotNull('description')
            ->latest('used_at')
            ->limit($limit)
            ->get();
    }
}
