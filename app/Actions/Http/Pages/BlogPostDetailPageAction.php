<?php

namespace App\Actions\Http\Pages;

use Illuminate\View\View;

class BlogPostDetailPageAction
{
    public function __invoke(int $id): View
    {
        $blogData = [
            'id' => $id,
            'title' => 'Artigo de Blog - Serviços Funerários',
            'excerpt' => 'Informações e orientações sobre serviços funerários.',
            'author' => 'Equipa Funerárias Portugal',
            'published_time' => now()->toISOString(),
            'image' => config('app.url').'/images/default-blog.jpg',
        ];

        return view('pages.blog-post-detail', [
            'id' => $id,
            'seoPage' => 'blog-post',
            'seoData' => $blogData,
        ]);
    }
}
