<?php

namespace App\Actions\Http\Pages;

use App\Domain\FuneralHomes\Services\FuneralHomeService;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CityFuneralHomesPageAction
{
    public function __construct(private FuneralHomeService $service) {}

    public function __invoke(string $citySlug): View|Response
    {
        $city = $this->service->getCityBySlug($citySlug);

        if (! $city) {
            abort(404);
        }

        $funeralHomes = $this->service->getFuneralHomesByCity($citySlug);

        return view('pages.city-funeral-homes', [
            'city' => $city,
            'funeralHomes' => $funeralHomes,
            'seoPage' => 'city-funeral-homes',
            'seoData' => ['city' => $city],
        ]);
    }
}
