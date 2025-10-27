<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_id',
        'original_url',
        'local_path',
        'filename',
        'mime_type',
        'file_size',
        'width',
        'height',
        'category',
        'is_downloaded',
        'downloaded_at',
    ];

    protected $casts = [
        'is_downloaded' => 'boolean',
        'downloaded_at' => 'datetime',
    ];

    public function entity(): BelongsTo
    {
        return $this->belongsTo(Entity::class);
    }

    public function getLocalUrlAttribute(): ?string
    {
        return $this->local_path ? asset('storage/'.$this->local_path) : null;
    }

    public function getOptimizedUrlAttribute(): ?string
    {
        if (! $this->local_path) {
            return null;
        }

        $originalPath = storage_path('app/public/'.$this->local_path);
        $service = app(\App\Services\ImageOptimizationService::class);

        return $service->getOptimizedImageUrl($originalPath, 'medium', 'webp');
    }

    public function getSmallUrlAttribute(): ?string
    {
        if (! $this->local_path) {
            return null;
        }

        $originalPath = storage_path('app/public/'.$this->local_path);
        $service = app(\App\Services\ImageOptimizationService::class);

        return $service->getOptimizedImageUrl($originalPath, 'small', 'webp');
    }

    public function getLargeUrlAttribute(): ?string
    {
        if (! $this->local_path) {
            return null;
        }

        $originalPath = storage_path('app/public/'.$this->local_path);
        $service = app(\App\Services\ImageOptimizationService::class);

        return $service->getOptimizedImageUrl($originalPath, 'large', 'webp');
    }

    public static function findByUrl(string $url): ?self
    {
        if (str_contains($url, 'storage/images/funeral-homes/')) {
            $imagePath = str_replace(asset('storage/'), '', $url);

            return self::query()->where('local_path', $imagePath)->first();
        }

        return null;
    }
}
