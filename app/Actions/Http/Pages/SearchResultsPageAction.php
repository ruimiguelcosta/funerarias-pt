<?php

namespace App\Actions\Http\Pages;

use App\Domain\FuneralHomes\Services\EntityService;
use App\Domain\Search\Data\SearchQueryData;
use App\Http\Requests\SearchRequest;
use Illuminate\Contracts\View\View;

class SearchResultsPageAction
{
    public function __construct(private EntityService $service) {}

    public function __invoke(SearchRequest $request): View
    {
        $data = SearchQueryData::from($request->validated());
        $entities = $this->service->search($data->q);

        return view('pages.search-results', [
            'entities' => $entities,
            'q' => $data->q,
        ]);
    }
}


