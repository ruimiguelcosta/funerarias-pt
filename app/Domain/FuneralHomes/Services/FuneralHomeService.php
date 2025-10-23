<?php

namespace App\Domain\FuneralHomes\Services;

use App\Models\FuneralHome;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class FuneralHomeService
{
    public function getFeaturedFuneralHomes(int $limit = 9): Collection
    {
        return Cache::remember('featured_funeral_homes', 86400, function () use ($limit) {
            return FuneralHome::query()
                ->with(['images', 'categories'])
                ->whereNotNull('city_slug')
                ->inRandomOrder()
                ->limit($limit)
                ->get();
        });
    }

    public function paginateFuneralHomes(int $perPage = 12): LengthAwarePaginator
    {
        return FuneralHome::query()
            ->with(['images', 'categories'])
            ->whereNotNull('city_slug')
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

    public function getRandomFuneralHomes(int $limit = 3): Collection
    {
        return FuneralHome::query()
            ->with(['images'])
            ->whereNotNull('city_slug')
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }

    public function getNearbyFuneralHomes(float $latitude, float $longitude, int $maxDistanceKm = 30, int $limit = 6): Collection
    {
        $funeralHomes = FuneralHome::query()
            ->with(['images', 'categories'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->whereNotNull('city_slug')
            ->get();

        $nearbyHomes = $funeralHomes->map(function ($home) use ($latitude, $longitude) {
            $distance = $this->calculateDistance(
                $latitude,
                $longitude,
                (float) $home->latitude,
                (float) $home->longitude
            );

            $home->distance = round($distance, 1);

            return $home;
        })
            ->filter(fn ($home) => $home->distance <= $maxDistanceKm)
            ->sortBy('distance')
            ->take($limit)
            ->values();

        return $nearbyHomes;
    }

    private function calculateDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthRadius = 6371;

        $latDiff = deg2rad($lat2 - $lat1);
        $lonDiff = deg2rad($lon2 - $lon1);

        $a = sin($latDiff / 2) * sin($latDiff / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($lonDiff / 2) * sin($lonDiff / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
