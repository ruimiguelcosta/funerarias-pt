<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    use BelongsToTenant, HasFactory;

    protected $fillable = [
        'tenant_id',
        'key',
        'group',
        'value',
        'type',
        'description',
    ];

    protected static function booted(): void
    {
        static::saved(function (SiteSetting $setting): void {
            $setting->clearCache();
        });

        static::deleted(function (SiteSetting $setting): void {
            $setting->clearCache();
        });
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function clearCache(): void
    {
        $tenantId = $this->tenant_id ?? config('app.current_tenant_id');
        Cache::forget("site_settings_tenant_{$tenantId}");
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        $tenantId = config('app.current_tenant_id');
        $cacheKey = "site_settings_tenant_{$tenantId}";

        $settings = Cache::remember($cacheKey, 3600, function () {
            return static::query()
                ->pluck('value', 'key')
                ->toArray();
        });

        return $settings[$key] ?? $default;
    }

    public static function set(string $key, mixed $value, string $group = 'general', string $type = 'text'): void
    {
        static::query()->updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'group' => $group,
                'type' => $type,
            ]
        );
    }
}
