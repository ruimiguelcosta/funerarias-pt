<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PeopleAlsoSearch extends Model
{
    use HasFactory;

    protected $table = 'people_also_search';

    protected $fillable = [
        'funeral_home_id',
        'category',
        'title',
        'reviews_count',
        'total_score',
    ];

    protected $casts = [
        'total_score' => 'decimal:1',
    ];

    public function funeralHome(): BelongsTo
    {
        return $this->belongsTo(FuneralHome::class);
    }
}
