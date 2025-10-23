<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    protected $fillable = [
        'session_id',
        'ip_address',
        'latitude',
        'longitude',
        'accuracy',
        'user_agent',
        'browser',
        'platform',
        'device',
        'permission_granted',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            'accuracy' => 'decimal:2',
            'permission_granted' => 'boolean',
        ];
    }
}
