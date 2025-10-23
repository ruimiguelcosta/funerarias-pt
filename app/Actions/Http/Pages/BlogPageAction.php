<?php

namespace App\Actions\Http\Pages;

use App\Domain\PostIdeas\Services\PostIdeaService;
use Illuminate\View\View;

class BlogPageAction
{
    public function __construct(private PostIdeaService $service) {}

    public function __invoke(): View
    {
        $posts = $this->service->getPublishedPosts(12);

        return view('pages.blog', [
            'seoPage' => 'blog',
            'posts' => $posts,
        ]);
    }
}
