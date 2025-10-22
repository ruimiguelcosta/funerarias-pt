<?php

namespace App\Actions\Http\Pages;

use App\Domain\FuneralHomes\Services\FuneralHomeService;
use Illuminate\View\View;

class FuneralHomesPageAction
{
    public function __construct(private FuneralHomeService $service) {}

    public function __invoke(): View
    {
        $funeralHomes = $this->service->paginateFuneralHomes();

        return view('pages.funeral-homes', [
            'funeralHomes' => $funeralHomes,
            'seoPage' => 'funeral-homes',
        ]);
    }
}
