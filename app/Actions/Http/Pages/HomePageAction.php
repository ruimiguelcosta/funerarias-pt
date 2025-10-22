<?php

namespace App\Actions\Http\Pages;

use App\Domain\FuneralHomes\Services\FuneralHomeService;
use Illuminate\View\View;

class HomePageAction
{
    public function __construct(private FuneralHomeService $service) {}

    public function __invoke(): View
    {
        $featuredFuneralHomes = $this->service->getFeaturedFuneralHomes();

        return view('pages.home', [
            'seoPage' => 'home',
            'featuredFuneralHomes' => $featuredFuneralHomes,
        ]);
    }
}
