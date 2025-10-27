<?php

namespace App\Actions\Http\Api;

use App\Domain\FuneralHomes\Services\EntityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetMapFuneralHomesAction
{
    public function __construct(private EntityService $service) {}

    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
        ]);

        $nearbyEntities = $this->service->getNearbyEntities(
            latitude: (float) $validated['latitude'],
            longitude: (float) $validated['longitude'],
            maxDistanceKm: 50,
            limit: 100
        );

        $formattedEntities = $nearbyEntities->map(function ($entity) {
            return [
                'id' => $entity->id,
                'title' => $entity->title,
                'slug' => $entity->slug,
                'city' => $entity->city,
                'city_slug' => $entity->city_slug,
                'phone' => $entity->phone,
                'latitude' => (float) $entity->latitude,
                'longitude' => (float) $entity->longitude,
                'distance' => $entity->distance,
                'url' => route('entity-detail', [
                    'citySlug' => $entity->city_slug,
                    'entitySlug' => $entity->slug,
                ]),
                'image' => $entity->images->where('category', 'main')->first()?->local_url ??
                          $entity->images->first()?->local_url ??
                          'https://images.unsplash.com/photo-1584907797015-7554cd315667?w=400&h=300&fit=crop',
            ];
        });

        return response()->json([
            'success' => true,
            'count' => $formattedEntities->count(),
            'entities' => $formattedEntities,
        ]);
    }
}
