<?php

namespace App\Actions\Http\Api;

use App\Domain\UserLocations\Data\UserLocationData;
use App\Domain\UserLocations\Services\UserLocationService;
use App\Http\Requests\StoreUserLocationRequest;
use Illuminate\Http\JsonResponse;
use Jenssegers\Agent\Agent;

class StoreUserLocationAction
{
    public function __construct(private UserLocationService $service) {}

    public function __invoke(StoreUserLocationRequest $request): JsonResponse
    {
        $sessionId = session()->getId();

        $agent = new Agent;
        $agent->setUserAgent($request->userAgent());

        $data = new UserLocationData(
            latitude: $request->validated('latitude'),
            longitude: $request->validated('longitude'),
            accuracy: $request->validated('accuracy'),
            sessionId: $sessionId,
            ipAddress: $request->ip(),
            userAgent: $request->userAgent(),
            browser: $agent->browser(),
            platform: $agent->platform(),
            device: $this->getDeviceType($agent),
            permissionGranted: true,
        );

        $location = $this->service->store($data);

        return response()->json([
            'success' => true,
            'message' => 'Localização guardada com sucesso',
            'location' => [
                'id' => $location->id,
                'latitude' => $location->latitude,
                'longitude' => $location->longitude,
            ],
        ], 201);
    }

    private function getDeviceType(Agent $agent): string
    {
        if ($agent->isDesktop()) {
            return 'desktop';
        }

        if ($agent->isTablet()) {
            return 'tablet';
        }

        if ($agent->isMobile()) {
            return 'mobile';
        }

        return 'unknown';
    }
}
