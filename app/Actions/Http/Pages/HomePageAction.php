<?php

namespace App\Actions\Http\Pages;

use App\Domain\FuneralHomes\Services\FuneralHomeService;
use App\Domain\PostIdeas\Services\PostIdeaService;
use Illuminate\View\View;

class HomePageAction
{
    public function __construct(
        private FuneralHomeService $funeralHomeService,
        private PostIdeaService $postIdeaService
    ) {}

    public function __invoke(): View
    {
        $featuredFuneralHomes = $this->funeralHomeService->getFeaturedFuneralHomes();
        $featuredPosts = $this->postIdeaService->getFeaturedPosts(3);

        return view('pages.home', [
            'seoPage' => 'home',
            'featuredFuneralHomes' => $featuredFuneralHomes,
            'featuredPosts' => $featuredPosts,
        ]);
    }
}
