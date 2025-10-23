<?php

namespace App\Domain\UserLocations\Data;

use Spatie\LaravelData\Data;

class UserLocationData extends Data
{
    public function __construct(
        public float $latitude,
        public float $longitude,
        public ?float $accuracy,
        public string $sessionId,
        public ?string $ipAddress,
        public ?string $userAgent,
        public ?string $browser,
        public ?string $platform,
        public ?string $device,
        public bool $permissionGranted = true,
    ) {}
}
