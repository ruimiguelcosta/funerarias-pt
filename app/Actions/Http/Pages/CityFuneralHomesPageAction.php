<?php

namespace App\Actions\Http\Pages;

use App\Domain\FuneralHomes\Services\EntityService;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CityFuneralHomesPageAction
{
    public function __construct(private EntityService $service) {}

    public function __invoke(string $citySlug): View|Response
    {
        $city = $this->service->getCityBySlug($citySlug);

        if (! $city) {
            abort(404);
        }

        $entities = $this->service->getEntitiesByCity($citySlug);

        return view('pages.city-funeral-homes', [
            'city' => $city,
            'entities' => $entities,
            'seoPage' => 'city-funeral-homes',
            'seoData' => ['city' => $city],
        ]);
    }
}
