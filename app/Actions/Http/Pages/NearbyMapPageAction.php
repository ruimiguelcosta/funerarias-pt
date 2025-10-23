<?php

namespace App\Actions\Http\Pages;

use Illuminate\View\View;

class NearbyMapPageAction
{
    public function __invoke(): View
    {
        return view('pages.nearby-map', [
            'seoPage' => 'nearby-map',
            'seoData' => [
                'title' => 'Mapa de Funerárias Próximas',
                'description' => 'Encontre funerárias próximas da sua localização no mapa interativo. Veja distâncias, contactos e informações detalhadas.',
            ],
            'mapboxApiKey' => config('services.mapbox.api_key'),
        ]);
    }
}
