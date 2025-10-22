<?php

namespace App\Domain\FuneralHomes\Services;

use App\Models\FuneralHome;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class FuneralHomeService
{
    public function getFeaturedFuneralHomes(int $limit = 9): Collection
    {
        return FuneralHome::query()
            ->with(['images', 'categories'])
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }

    public function paginateFuneralHomes(int $perPage = 12): LengthAwarePaginator
    {
        return FuneralHome::query()
            ->with(['images', 'categories'])
            ->paginate($perPage);
    }

    public function getFuneralHomesByCity(string $citySlug): LengthAwarePaginator
    {
        return FuneralHome::query()
            ->with(['images', 'categories'])
            ->where('city_slug', $citySlug)
            ->paginate(12);
    }

    public function getCityBySlug(string $citySlug): ?FuneralHome
    {
        return FuneralHome::query()
            ->where('city_slug', $citySlug)
            ->first();
    }

    public function getFuneralHomeBySlug(string $citySlug, string $funeralHomeSlug): FuneralHome
    {
        return FuneralHome::query()
            ->with(['reviews', 'images', 'categories'])
            ->where('city_slug', $citySlug)
            ->where('slug', $funeralHomeSlug)
            ->firstOrFail();
    }
}
