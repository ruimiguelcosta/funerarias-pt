@props([
    'id',
    'title',
    'slug',
    'excerpt',
    'image' => null,
    'category' => null,
    'date',
    'readTime' => '5 min'
])

<article class="group bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
    <a href="{{ route('blog-post-detail', $slug) }}" class="block">
        <div class="relative h-48 overflow-hidden bg-gray-200">
            @if($image && file_exists(storage_path('app/public/' . $image)))
                <img 
                    src="{{ asset('storage/' . $image) }}" 
                    alt="{{ $title }}"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                    loading="lazy"
                >
            @else
                <div class="w-full h-full bg-gradient-to-br from-purple-100 to-purple-200 flex items-center justify-center">
                    <span class="text-6xl">📝</span>
                </div>
            @endif
            @if($category)
                <span class="absolute top-4 left-4 bg-purple-600 text-white px-3 py-1 rounded-full text-xs font-medium">
                    {{ $category }}
                </span>
            @endif
        </div>

        <div class="p-6">
            <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    {{ $date }}
                </span>
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ $readTime }} leitura
                </span>
            </div>

            <h3 class="font-playfair text-xl font-bold text-gray-900 mb-3 group-hover:text-purple-600 transition-colors duration-300 line-clamp-2">
                {{ $title }}
            </h3>

            <p class="text-gray-600 mb-4 line-clamp-3">
                {{ $excerpt }}
            </p>

            <div class="flex items-center text-purple-600 font-medium text-sm group-hover:gap-2 transition-all duration-300">
                <span>Ler mais</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </div>
    </a>
</article>

