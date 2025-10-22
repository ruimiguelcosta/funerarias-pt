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

        $sitemap->add(Url::create('/')
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(1.0));

        $sitemap->add(Url::create('/funerarias')
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(0.9));

        $sitemap->add(Url::create('/quem-somos')
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setPriority(0.7));

        $sitemap->add(Url::create('/politica-privacidade')
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.3));

        $sitemap->add(Url::create('/politica-cookies')
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.3));

        FuneralHome::query()
            ->whereNotNull('slug')
            ->chunk(100, function ($funeralHomes) use ($sitemap) {
                foreach ($funeralHomes as $funeralHome) {
                    $sitemap->add(Url::create("/funeraria/{$funeralHome->slug}")
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
