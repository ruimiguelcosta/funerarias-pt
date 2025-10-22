<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'funeral_home_id',
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

    public function funeralHome(): BelongsTo
    {
        return $this->belongsTo(FuneralHome::class);
    }

    public function getLocalUrlAttribute(): ?string
    {
        return $this->local_path ? asset('storage/' . $this->local_path) : null;
    }
}
