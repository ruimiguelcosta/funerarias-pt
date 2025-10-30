<?php

namespace App\Domain\FuneralHomes\Services;

use App\Models\Entity;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class EntityService
{
    public function getFeaturedEntities(int $limit = 9): Collection
    {
        $tenantId = config('app.current_tenant_id');
        $cacheKey = "featured_entities_tenant_{$tenantId}";

        return Cache::remember($cacheKey, 86400, function () use ($limit) {
            return Entity::query()
                ->with(['images', 'categories'])
                ->whereNotNull('city_slug')
                ->inRandomOrder()
                ->limit($limit)
                ->get();
        });
    }

    public function paginateEntities(int $perPage = 12): LengthAwarePaginator
    {
        return Entity::query()
            ->with(['images', 'categories'])
            ->whereNotNull('city_slug')
            ->paginate($perPage);
    }

    public function getEntitiesByCity(string $citySlug): LengthAwarePaginator
    {
        return Entity::query()
            ->with(['images', 'categories'])
            ->where('city_slug', $citySlug)
            ->paginate(12);
    }

    public function getCityBySlug(string $citySlug): ?Entity
    {
        return Entity::query()
            ->where('city_slug', $citySlug)
            ->first();
    }

    public function getEntityBySlug(string $citySlug, string $entitySlug): Entity
    {
        return Entity::query()
            ->with(['reviews', 'images', 'categories'])
            ->where('city_slug', $citySlug)
            ->where('slug', $entitySlug)
            ->firstOrFail();
    }

    public function getRandomEntities(int $limit = 3): Collection
    {
        return Entity::query()
            ->with(['images'])
            ->whereNotNull('city_slug')
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }

    public function getNearbyEntities(float $latitude, float $longitude, int $maxDistanceKm = 30, int $limit = 6): Collection
    {
        $entities = Entity::query()
            ->with(['images', 'categories'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->whereNotNull('city_slug')
            ->get();

        $nearbyEntities = $entities->map(function ($entity) use ($latitude, $longitude) {
            $distance = $this->calculateDistance(
                $latitude,
                $longitude,
                (float) $entity->latitude,
                (float) $entity->longitude
            );

            $entity->distance = round($distance, 1);

            return $entity;
        })
            ->filter(fn ($entity) => $entity->distance <= $maxDistanceKm)
            ->sortBy('distance')
            ->take($limit)
            ->values();

        return $nearbyEntities;
    }

    public function search(string $query, int $perPage = 12): LengthAwarePaginator
    {
        $columns = ['title', 'description', 'category_name', 'address'];
        $driver = DB::connection()->getDriverName();

        $builder = Entity::query()
            ->with(['images', 'categories'])
            ->whereNotNull('city_slug');

        $cityTerm = null;
        if (preg_match('/\\b(?:em|no|na|de)\\s+([\\p{L}\\- ]{3,})$/iu', $query, $m)) {
            $cityTerm = trim($m[1]);
        }

        if ($cityTerm) {
            $builder->where(function ($q) use ($cityTerm) {
                $q->where('city', 'like', '%'.$cityTerm.'%')
                  ->orWhere('city_slug', 'like', '%'.strtolower(str_replace(' ', '-', $cityTerm)).'%')
                  ->orWhere('address', 'like', '%'.$cityTerm.'%');
            });
        }

        if (in_array($driver, ['mysql', 'mariadb'])) {
            $builder->whereFullText($columns, $query);
            $builder->orderByRaw('MATCH (title, description, category_name, address) AGAINST (? IN NATURAL LANGUAGE MODE) DESC', [$query]);
        } else {
            $builder->where(function ($q) use ($columns, $query) {
                foreach ($columns as $col) {
                    $q->orWhere($col, 'like', '%'.$query.'%');
                }
            });

            if ($cityTerm) {
                $builder->orderByRaw('CASE WHEN city LIKE ? THEN 0 WHEN address LIKE ? THEN 1 ELSE 2 END', ['%'.$cityTerm.'%', '%'.$cityTerm.'%']);
            }
        }

        return $builder->paginate($perPage)->appends(['q' => $query]);
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
