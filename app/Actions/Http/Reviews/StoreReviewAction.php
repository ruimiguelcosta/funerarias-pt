<?php

namespace App\Actions\Http\Reviews;

use App\Domain\Reviews\Data\ReviewData;
use App\Domain\Reviews\Services\ReviewService;
use App\Http\Requests\Reviews\StoreReviewRequest;
use Illuminate\Http\RedirectResponse;

class StoreReviewAction
{
    public function __construct(private ReviewService $service) {}

    public function __invoke(StoreReviewRequest $request): RedirectResponse
    {
        $data = ReviewData::from($request->validated());
        $this->service->store($data);

        return redirect()->back()->with('success', 'A sua avaliação foi enviada com sucesso! Obrigado pelo seu feedback.');
    }
}
