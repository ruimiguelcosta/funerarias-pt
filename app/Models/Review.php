<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'funeral_home_id',
        'author_name',
        'author_photo_url',
        'rating',
        'text',
        'published_at',
        'review_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function funeralHome(): BelongsTo
    {
        return $this->belongsTo(FuneralHome::class);
    }
}
