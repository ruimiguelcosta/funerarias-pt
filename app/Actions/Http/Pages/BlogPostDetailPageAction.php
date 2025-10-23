<?php

namespace App\Actions\Http\Pages;

use App\Models\PostIdea;
use Illuminate\View\View;

class BlogPostDetailPageAction
{
    public function __invoke(string $slug): View
    {
        $post = PostIdea::query()
            ->where('slug', $slug)
            ->where('is_used', true)
            ->whereNotNull('description')
            ->firstOrFail();

        $blogData = [
            'id' => $post->id,
            'title' => $post->meta_title ?? $post->title,
            'excerpt' => $post->meta_description ?? '',
            'author' => 'Equipa Funerárias Portugal',
            'published_time' => $post->used_at?->toISOString() ?? $post->created_at->toISOString(),
            'image' => $post->image ? asset('storage/'.$post->image) : config('app.url').'/images/default-blog.jpg',
        ];

        return view('pages.blog-post-detail', [
            'post' => $post,
            'seoPage' => 'blog-post',
            'seoData' => $blogData,
        ]);
    }
}
