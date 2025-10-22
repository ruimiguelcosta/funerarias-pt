<div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-200">
    <div class="aspect-video overflow-hidden">
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover hover:scale-105 transition-all duration-300">
    </div>
    <div class="p-6">
        <div class="flex items-center gap-2 mb-3">
            <span class="text-xs font-semibold text-yellow-800 px-3 py-1 rounded-full bg-yellow-100">
                {{ $category }}
            </span>
        </div>
        <h3 class="font-playfair text-xl text-gray-900 mb-3">{{ $title }}</h3>
        <div class="flex items-center gap-4 text-sm text-gray-600 mb-3">
            <span class="flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                {{ $author }}
            </span>
            <span class="flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $date }}
            </span>
        </div>
        <p class="text-gray-600 mb-4">{{ $excerpt }}</p>
        <a href="{{ route('blog-post-detail', $id) }}">
            <button class="w-full border border-gray-300 text-gray-700 py-3 rounded-lg font-medium hover:bg-gray-50 transition-all duration-300">
                Ler Mais
            </button>
        </a>
    </div>
</div>
