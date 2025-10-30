<?php

namespace App\Actions\Http;

use App\Models\Entity;
use App\Models\Tenant;
use Illuminate\Http\Response;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemapAction
{
    public function __invoke(?Tenant $tenant = null): Response
    {
        $sitemap = Sitemap::create();

        $tenant = $tenant ?? app('tenant');

        if (! $tenant) {
            abort(404, 'Tenant not found');
        }

        $baseUrl = $tenant->domain;

        $sitemap->add(Url::create($baseUrl)
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(1.0));

        $sitemap->add(Url::create($baseUrl.'/funerarias')
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(0.9));

        $sitemap->add(Url::create($baseUrl.'/quem-somos')
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setPriority(0.7));

        $sitemap->add(Url::create($baseUrl.'/politica-privacidade')
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.3));

        $sitemap->add(Url::create($baseUrl.'/politica-cookies')
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.3));

        $cities = Entity::query()
            ->select('city_slug', 'city')
            ->where('tenant_id', $tenant->id)
            ->whereNotNull('city_slug')
            ->distinct()
            ->get();

        foreach ($cities as $city) {
            $sitemap->add(Url::create($baseUrl."/{$city->city_slug}")
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.7));
        }

        Entity::query()
            ->where('tenant_id', $tenant->id)
            ->whereNotNull('slug')
            ->whereNotNull('city_slug')
            ->chunk(100, function ($entities) use ($sitemap, $baseUrl) {
                foreach ($entities as $entity) {
                    $sitemap->add(Url::create($baseUrl."/{$entity->city_slug}/{$entity->slug}")
                        ->setLastModificationDate($entity->scraped_at ?? now())
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setPriority(0.8));
                }
            });

        return response($sitemap->render(), 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
