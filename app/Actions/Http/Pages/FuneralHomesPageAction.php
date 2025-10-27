<?php

namespace App\Actions\Http\Pages;

use App\Domain\FuneralHomes\Services\EntityService;
use Illuminate\View\View;

class FuneralHomesPageAction
{
    public function __construct(private EntityService $service) {}

    public function __invoke(): View
    {
        $entities = $this->service->paginateEntities();

        return view('pages.funeral-homes', [
            'entities' => $entities,
            'seoPage' => 'funeral-homes',
        ]);
    }
}
