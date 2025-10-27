<?php

namespace App\Actions\Http\Pages;

use App\Domain\FuneralHomes\Services\EntityService;
use Illuminate\View\View;

class FuneralHomeDetailPageAction
{
    public function __construct(private EntityService $service) {}

    public function __invoke(string $citySlug, string $entitySlug): View
    {
        $entity = $this->service->getEntityBySlug($citySlug, $entitySlug);

        return view('pages.funeral-home-detail', [
            'entity' => $entity,
            'seoPage' => 'funeral-home-detail',
            'seoData' => ['entity' => $entity],
        ]);
    }
}
