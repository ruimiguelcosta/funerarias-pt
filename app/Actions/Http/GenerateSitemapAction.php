<?php

namespace App\Actions\Http;

use App\Models\FuneralHome;
use Illuminate\Http\Response;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemapAction
{
    public function __invoke(): Response
    {
        $sitemap = Sitemap::create();

        $baseUrl = config('app.env') === 'local'
            ? config('app.url')
            : 'https://funerariasemportugal.com';

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

        // Add city pages
        $cities = FuneralHome::query()
            ->select('city_slug', 'city')
            ->whereNotNull('city_slug')
            ->distinct()
            ->get();

        foreach ($cities as $city) {
            $sitemap->add(Url::create($baseUrl."/{$city->city_slug}")
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.7));
        }

        // Add funeral home detail pages
        FuneralHome::query()
            ->whereNotNull('slug')
            ->whereNotNull('city_slug')
            ->chunk(100, function ($funeralHomes) use ($sitemap, $baseUrl) {
                foreach ($funeralHomes as $funeralHome) {
                    $sitemap->add(Url::create($baseUrl."/{$funeralHome->city_slug}/{$funeralHome->slug}")
                        ->setLastModificationDate($funeralHome->scraped_at ?? now())
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setPriority(0.8));
                }
            });

        return response($sitemap->render(), 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
