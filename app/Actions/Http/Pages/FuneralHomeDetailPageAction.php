<?php

namespace App\Actions\Http\Pages;

use App\Domain\FuneralHomes\Services\FuneralHomeService;
use Illuminate\View\View;

class FuneralHomeDetailPageAction
{
    public function __construct(private FuneralHomeService $service) {}

    public function __invoke(string $citySlug, string $funeralHomeSlug): View
    {
        $funeralHome = $this->service->getFuneralHomeBySlug($citySlug, $funeralHomeSlug);

        return view('pages.funeral-home-detail', [
            'funeralHome' => $funeralHome,
            'seoPage' => 'funeral-home-detail',
            'seoData' => ['funeralHome' => $funeralHome],
        ]);
    }
}
