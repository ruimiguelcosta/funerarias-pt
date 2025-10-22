<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OpeningHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'funeral_home_id',
        'day',
        'hours',
    ];

    public function funeralHome(): BelongsTo
    {
        return $this->belongsTo(FuneralHome::class);
    }
}
