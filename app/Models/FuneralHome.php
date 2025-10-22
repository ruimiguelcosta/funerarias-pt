<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class FuneralHome extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'price',
        'category_name',
        'address',
        'neighborhood',
        'street',
        'city',
        'city_slug',
        'postal_code',
        'state',
        'country_code',
        'phone',
        'phone_unformatted',
        'website',
        'description',
        'generated_description',
        'description_generated_at',
        'sub_title',
        'located_in',
        'plus_code',
        'latitude',
        'longitude',
        'permanently_closed',
        'temporarily_closed',
        'claim_this_business',
        'place_id',
        'fid',
        'cid',
        'reviews_count',
        'images_count',
        'total_score',
        'image_url',
        'kgmid',
        'url',
        'search_page_url',
        'search_string',
        'language',
        'rank',
        'is_advertisement',
        'is_suggested',
        'is_accepted',
        'scraped_at',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'total_score' => 'decimal:1',
        'permanently_closed' => 'boolean',
        'temporarily_closed' => 'boolean',
        'claim_this_business' => 'boolean',
        'is_advertisement' => 'boolean',
        'is_suggested' => 'boolean',
        'is_accepted' => 'boolean',
        'scraped_at' => 'datetime',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'funeral_home_categories');
    }

    public function openingHours(): HasMany
    {
        return $this->hasMany(OpeningHour::class);
    }

    public function peopleAlsoSearch(): HasMany
    {
        return $this->hasMany(PeopleAlsoSearch::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getUrlAttribute(): string
    {
        return route('funeral-home-detail', [
            'citySlug' => $this->city_slug,
            'funeralHomeSlug' => $this->slug
        ]);
    }
}
