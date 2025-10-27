<?php

namespace App\Actions\Http\Api;

use App\Domain\FuneralHomes\Services\EntityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetNearbyFuneralHomesAction
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
            maxDistanceKm: 30,
            limit: 6
        );

        $formattedEntities = $nearbyEntities->map(function ($entity) {
            return [
                'id' => $entity->id,
                'title' => $entity->title,
                'slug' => $entity->slug,
                'city' => $entity->city,
                'city_slug' => $entity->city_slug,
                'country_code' => $entity->country_code,
                'address' => $entity->address,
                'phone' => $entity->phone,
                'total_score' => $entity->total_score,
                'reviews_count' => $entity->reviews_count,
                'description' => $entity->description ? str($entity->description)->limit(120)->toString() : 'Serviços funerários com tradição e respeito.',
                'distance' => $entity->distance,
                'url' => route('entity-detail', [
                    'citySlug' => $entity->city_slug,
                    'entitySlug' => $entity->slug,
                ]),
                'image' => $entity->images->where('category', 'main')->first()?->local_url ??
                          $entity->images->first()?->local_url ??
                          'https://images.unsplash.com/photo-1584907797015-7554cd315667?w=400&h=300&fit=crop',
                'categories' => $entity->categories->pluck('name')->toArray(),
            ];
        });

        return response()->json([
            'success' => true,
            'count' => $formattedEntities->count(),
            'entities' => $formattedEntities,
        ]);
    }
}
