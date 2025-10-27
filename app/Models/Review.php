<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_id',
        'author_name',
        'author_photo_url',
        'rating',
        'text',
        'published_at',
        'review_id',
    ];

    public function getCommentAttribute()
    {
        return $this->text;
    }

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function entity(): BelongsTo
    {
        return $this->belongsTo(Entity::class);
    }
}
