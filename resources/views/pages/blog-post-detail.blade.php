@extends('layouts.app')

@section('title', $post->meta_title ?? $post->title)

@section('content')
<div class="pt-20">
    <article class="container mx-auto px-4 py-12 max-w-4xl">
        <a href="{{ route('blog') }}" class="inline-flex items-center text-gray-600 hover:text-purple-700 mb-6">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Voltar ao Blog
        </a>

        @if($post->category)
        <div class="mb-6">
            <span class="text-sm font-semibold text-yellow-800 px-3 py-1 rounded-full bg-yellow-100">
                {{ $post->category }}
            </span>
        </div>
        @endif

        <h1 class="font-playfair text-4xl md:text-5xl font-bold text-purple-700 mb-6">
            {{ $post->title }}
        </h1>

        <div class="flex items-center gap-6 text-gray-600 mb-8">
            <span class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Equipa Funerárias Portugal
            </span>
            <span class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $post->used_at ? $post->used_at->format('d \d\e F, Y') : $post->created_at->format('d \d\e F, Y') }}
            </span>
        </div>

        @if($post->image)
        <div class="aspect-video overflow-hidden rounded-lg mb-8">
            <img src="{{ asset('storage/' . $post->image) }}" 
                 alt="{{ $post->title }}"
                 class="w-full h-full object-cover">
        </div>
        @endif

        <div class="prose prose-lg max-w-none prose-headings:font-playfair prose-headings:text-purple-700 prose-a:text-purple-600 prose-a:no-underline hover:prose-a:underline">
            {!! $post->description !!}
        </div>

        <div class="mt-12 pt-8 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Partilhar este artigo</h3>
                    <div class="flex gap-3">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                           target="_blank"
                           class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" 
                           target="_blank"
                           class="flex items-center justify-center w-10 h-10 rounded-full bg-sky-500 text-white hover:bg-sky-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($post->title) }}" 
                           target="_blank"
                           class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-700 text-white hover:bg-blue-800 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-gray-200">
            <h3 class="font-playfair text-2xl font-bold text-purple-700 mb-6">Outros artigos que pode interessar</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @php
                    $relatedPosts = \App\Models\PostIdea::query()
                        ->where('is_used', true)
                        ->whereNotNull('description')
                        ->where('id', '!=', $post->id)
                        ->inRandomOrder()
                        ->limit(2)
                        ->get();
                @endphp

                @foreach($relatedPosts as $relatedPost)
                    <a href="{{ route('blog-post-detail', $relatedPost->slug) }}" class="group">
                        <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-300">
                            @if($relatedPost->image)
                                <div class="aspect-video overflow-hidden">
                                    <img src="{{ asset('storage/' . $relatedPost->image) }}" 
                                         alt="{{ $relatedPost->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                            @else
                                <div class="aspect-video bg-gradient-to-br from-purple-100 to-purple-200 flex items-center justify-center">
                                    <span class="text-6xl">📝</span>
                                </div>
                            @endif
                            <div class="p-4">
                                <h4 class="font-playfair text-lg font-semibold text-gray-900 group-hover:text-purple-600 transition-colors line-clamp-2">
                                    {{ $relatedPost->title }}
                                </h4>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </article>
</div>
@endsection
