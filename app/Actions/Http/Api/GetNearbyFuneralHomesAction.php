<?php

namespace App\Actions\Http\Api;

use App\Domain\FuneralHomes\Services\FuneralHomeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetNearbyFuneralHomesAction
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
            maxDistanceKm: 30,
            limit: 6
        );

        $formattedHomes = $nearbyHomes->map(function ($home) {
            return [
                'id' => $home->id,
                'title' => $home->title,
                'slug' => $home->slug,
                'city' => $home->city,
                'city_slug' => $home->city_slug,
                'country_code' => $home->country_code,
                'address' => $home->address,
                'phone' => $home->phone,
                'total_score' => $home->total_score,
                'reviews_count' => $home->reviews_count,
                'description' => $home->description ? str($home->description)->limit(120)->toString() : 'Serviços funerários com tradição e respeito.',
                'distance' => $home->distance,
                'url' => route('funeral-home-detail', [
                    'citySlug' => $home->city_slug,
                    'funeralHomeSlug' => $home->slug,
                ]),
                'image' => $home->images->where('category', 'main')->first()?->local_url ??
                          $home->images->first()?->local_url ??
                          'https://images.unsplash.com/photo-1584907797015-7554cd315667?w=400&h=300&fit=crop',
                'categories' => $home->categories->pluck('name')->toArray(),
            ];
        });

        return response()->json([
            'success' => true,
            'count' => $formattedHomes->count(),
            'funeral_homes' => $formattedHomes,
        ]);
    }
}
