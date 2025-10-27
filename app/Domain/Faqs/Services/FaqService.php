<?php

namespace App\Domain\Faqs\Services;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class FaqService
{
    public function getActiveFaqs(): Collection
    {
        $tenantId = config('app.current_tenant_id');
        $cacheKey = "active_faqs_tenant_{$tenantId}";

        return Cache::remember($cacheKey, 3600, function () {
            return Faq::query()
                ->where('is_active', true)
                ->orderBy('order')
                ->get();
        });
    }

    public function getAllFaqs(): Collection
    {
        return Faq::query()
            ->orderBy('order')
            ->get();
    }
}
