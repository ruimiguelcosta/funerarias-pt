@props(['reviews' => [], 'funeralHome' => null])

@if(count($reviews) > 0)
<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <h3 class="text-xl font-semibold text-gray-900 mb-4">Avaliações dos Clientes</h3>
    
    <div class="space-y-4">
        @foreach($reviews->take(5) as $review)
        <div class="border-b border-gray-100 pb-4 last:border-b-0">
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center space-x-2">
                    <div class="flex items-center">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating)
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @else
                                <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endif
                        @endfor
                    </div>
                    <span class="text-sm font-medium text-gray-900">{{ $review->rating }}/5</span>
                </div>
                <time class="text-sm text-gray-500" datetime="{{ $review->created_at->toISOString() }}">
                    {{ $review->created_at->format('d/m/Y') }}
                </time>
            </div>
            
            @if($review->comment)
            <p class="text-gray-700 text-sm leading-relaxed">{{ $review->comment }}</p>
            @endif
            
            @if($review->author_name)
            <p class="text-xs text-gray-500 mt-2">Por {{ $review->author_name }}</p>
            @endif
        </div>
        @endforeach
    </div>
    
    @if($reviews->count() > 5)
    <div class="mt-4 text-center">
        <button class="text-purple-600 hover:text-purple-800 text-sm font-medium">
            Ver todas as {{ $reviews->count() }} avaliações
        </button>
    </div>
    @endif
</div>

<!-- JSON-LD Reviews Schema -->
@if($funeralHome)
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FuneralHome",
    "name": "{{ $funeralHome->title }}",
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "{{ $funeralHome->total_score ?? 0 }}",
        "reviewCount": "{{ $funeralHome->reviews_count ?? 0 }}",
        "bestRating": "5",
        "worstRating": "1"
    },
    "review": [
        @foreach($reviews->take(5) as $index => $review)
        {
            "@type": "Review",
            "author": {
                "@type": "Person",
                "name": "{{ $review->author_name ?? 'Cliente' }}"
            },
            "reviewRating": {
                "@type": "Rating",
                "ratingValue": "{{ $review->rating }}",
                "bestRating": "5",
                "worstRating": "1"
            },
            "reviewBody": "{{ $review->comment ?? '' }}",
            "datePublished": "{{ $review->created_at->toISOString() }}"
        }{{ $index < min(4, $reviews->count() - 1) ? ',' : '' }}
        @endforeach
    ]
}
</script>
@endif
@endif
