<?php

namespace App\Actions\Http\Api;

use App\Domain\FuneralHomes\Services\FuneralHomeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetMapFuneralHomesAction
{
    public function __construct(private FuneralHomeService $service) {}

    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
        ]);

        $nearbyHomes = $this->service->getNearbyFuneralHomes(
            latitude: (float) $validated['latitude'],
            longitude: (float) $validated['longitude'],
            maxDistanceKm: 50,
            limit: 100
        );

        $formattedHomes = $nearbyHomes->map(function ($home) {
            return [
                'id' => $home->id,
                'title' => $home->title,
                'slug' => $home->slug,
                'city' => $home->city,
                'city_slug' => $home->city_slug,
                'phone' => $home->phone,
                'latitude' => (float) $home->latitude,
                'longitude' => (float) $home->longitude,
                'distance' => $home->distance,
                'url' => route('funeral-home-detail', [
                    'citySlug' => $home->city_slug,
                    'funeralHomeSlug' => $home->slug,
                ]),
                'image' => $home->images->where('category', 'main')->first()?->local_url ??
                          $home->images->first()?->local_url ??
                          'https://images.unsplash.com/photo-1584907797015-7554cd315667?w=400&h=300&fit=crop',
            ];
        });

        return response()->json([
            'success' => true,
            'count' => $formattedHomes->count(),
            'funeral_homes' => $formattedHomes,
        ]);
    }
}
