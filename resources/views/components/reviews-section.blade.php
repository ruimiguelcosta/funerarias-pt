@props(['reviews' => [], 'funeralHome' => null])

<!-- Review Form -->
<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
    <h3 class="text-xl font-semibold text-gray-900 mb-4">Deixe a sua Avaliação</h3>
    
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
            {{ session('success') }}
        </div>
    @endif
    
    <form action="{{ route('reviews.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="funeral_home_id" value="{{ $funeralHome->id }}">
        
        <!-- Rating -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Avaliação</label>
            <div class="flex items-center space-x-1" id="rating-container">
                @for($i = 1; $i <= 5; $i++)
                    <button type="button" class="rating-star w-8 h-8 text-gray-300 hover:text-yellow-400 transition-colors duration-200" data-rating="{{ $i }}">
                        <svg class="w-full h-full" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </button>
                @endfor
            </div>
            <input type="hidden" name="rating" id="rating-input" value="0" required>
            @error('rating')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Name -->
        <div>
            <label for="author_name" class="block text-sm font-medium text-gray-700 mb-2">Nome</label>
            <input type="text" name="author_name" id="author_name" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                   placeholder="O seu nome" value="{{ old('author_name') }}" required>
            @error('author_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        
        <!-- Comment -->
        <div>
            <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Comentário</label>
            <textarea name="comment" id="comment" rows="4" 
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                      placeholder="Partilhe a sua experiência..." required>{{ old('comment') }}</textarea>
            @error('comment')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" 
                    class="bg-gradient-to-r from-purple-600 to-purple-500 text-white px-6 py-2 rounded-lg font-medium hover:opacity-90 transition-all duration-300">
                Enviar Avaliação
            </button>
        </div>
    </form>
</div>

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
                <time class="text-sm text-gray-500" datetime="{{ $review->published_at->toISOString() }}">
                    {{ $review->published_at->format('d/m/Y') }}
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
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FuneralHome',
    'name' => $funeralHome->title,
    'aggregateRating' => $funeralHome->total_score ? [
        '@type' => 'AggregateRating',
        'ratingValue' => $funeralHome->total_score,
        'reviewCount' => $funeralHome->reviews_count ?? 0,
        'bestRating' => 5,
        'worstRating' => 1
    ] : null,
    'review' => $reviews->take(5)->map(function($review) {
        return [
            '@type' => 'Review',
            'author' => [
                '@type' => 'Person',
                'name' => $review->author_name ?? 'Cliente'
            ],
            'reviewRating' => [
                '@type' => 'Rating',
                'ratingValue' => $review->rating,
                'bestRating' => 5,
                'worstRating' => 1
            ],
            'reviewBody' => $review->comment ?? '',
            'datePublished' => $review->published_at->toISOString()
        ];
    })->toArray()
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endif
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ratingStars = document.querySelectorAll('.rating-star');
    const ratingInput = document.getElementById('rating-input');
    
    ratingStars.forEach((star, index) => {
        star.addEventListener('click', function() {
            const rating = parseInt(this.dataset.rating);
            ratingInput.value = rating;
            
            // Update visual state
            ratingStars.forEach((s, i) => {
                if (i < rating) {
                    s.classList.remove('text-gray-300');
                    s.classList.add('text-yellow-400');
                } else {
                    s.classList.remove('text-yellow-400');
                    s.classList.add('text-gray-300');
                }
            });
        });
        
        star.addEventListener('mouseenter', function() {
            const rating = parseInt(this.dataset.rating);
            ratingStars.forEach((s, i) => {
                if (i < rating) {
                    s.classList.remove('text-gray-300');
                    s.classList.add('text-yellow-400');
                } else {
                    s.classList.remove('text-yellow-400');
                    s.classList.add('text-gray-300');
                }
            });
        });
    });
    
    // Reset on mouse leave
    document.getElementById('rating-container').addEventListener('mouseleave', function() {
        const currentRating = parseInt(ratingInput.value);
        ratingStars.forEach((s, i) => {
            if (i < currentRating) {
                s.classList.remove('text-gray-300');
                s.classList.add('text-yellow-400');
            } else {
                s.classList.remove('text-yellow-400');
                s.classList.add('text-gray-300');
            }
        });
    });
});
</script>
