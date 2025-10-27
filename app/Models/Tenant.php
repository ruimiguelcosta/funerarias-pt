<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'domain',
        'logo',
        'is_enabled',
        'settings',
    ];

    protected function casts(): array
    {
        return [
            'is_enabled' => 'boolean',
            'settings' => 'array',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Tenant $tenant): void {
            if (empty($tenant->slug)) {
                $tenant->slug = Str::slug($tenant->name);
            }
        });
    }

    public function entities(): HasMany
    {
        return $this->hasMany(Entity::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function postIdeas(): HasMany
    {
        return $this->hasMany(PostIdea::class);
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class);
    }

    public function siteSettings(): HasMany
    {
        return $this->hasMany(SiteSetting::class);
    }

    public function getStatcounterProject(): ?string
    {
        return $this->settings['statcounter']['sc_project'] ?? null;
    }

    public function getStatcounterSecurity(): ?string
    {
        return $this->settings['statcounter']['sc_security'] ?? null;
    }

    public function hasStatcounter(): bool
    {
        return ! empty($this->settings['statcounter']['sc_project']) && ! empty($this->settings['statcounter']['sc_security']);
    }
}
