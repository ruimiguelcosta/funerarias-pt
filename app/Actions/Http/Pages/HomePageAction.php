<?php

namespace App\Actions\Http\Pages;

use App\Domain\Faqs\Services\FaqService;
use App\Domain\FuneralHomes\Services\EntityService;
use App\Domain\PostIdeas\Services\PostIdeaService;
use Illuminate\View\View;

class HomePageAction
{
    public function __construct(
        private EntityService $entityService,
        private PostIdeaService $postIdeaService,
        private FaqService $faqService
    ) {}

    public function __invoke(): View
    {
        $featuredEntities = $this->entityService->getFeaturedEntities();
        $featuredPosts = $this->postIdeaService->getFeaturedPosts(3);
        $faqs = $this->faqService->getActiveFaqs();

        return view('pages.home', [
            'seoPage' => 'home',
            'featuredEntities' => $featuredEntities,
            'featuredPosts' => $featuredPosts,
            'faqs' => $faqs,
        ]);
    }
}
