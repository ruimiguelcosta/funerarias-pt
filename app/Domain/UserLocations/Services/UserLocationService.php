<?php

namespace App\Domain\UserLocations\Services;

use App\Domain\UserLocations\Data\UserLocationData;
use App\Models\UserLocation;

class UserLocationService
{
    public function store(UserLocationData $data): UserLocation
    {
        return UserLocation::query()->create([
            'session_id' => $data->sessionId,
            'ip_address' => $data->ipAddress,
            'latitude' => $data->latitude,
            'longitude' => $data->longitude,
            'accuracy' => $data->accuracy,
            'user_agent' => $data->userAgent,
            'browser' => $data->browser,
            'platform' => $data->platform,
            'device' => $data->device,
            'permission_granted' => $data->permissionGranted,
        ]);
    }

    public function getRecentLocationsBySessionId(string $sessionId, int $limit = 10): \Illuminate\Database\Eloquent\Collection
    {
        return UserLocation::query()
            ->where('session_id', $sessionId)
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function getLastLocationBySessionId(string $sessionId): ?UserLocation
    {
        return UserLocation::query()
            ->where('session_id', $sessionId)
            ->latest()
            ->first();
    }
}
