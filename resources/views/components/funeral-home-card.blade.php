<div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 border border-gray-200 flex flex-col h-full">
    @if($city_slug)
        <a href="{{ route('funeral-home-detail', ['citySlug' => $city_slug, 'funeralHomeSlug' => $slug]) }}" class="block">
    @else
        <div class="block cursor-not-allowed opacity-50">
    @endif
        <div class="h-48 overflow-hidden">
            <img src="{{ $image }}" alt="{{ $name }}" class="w-full h-full object-cover hover:scale-105 transition-all duration-300">
        </div>
    @if($city_slug)
        </a>
    @else
        </div>
    @endif
    <div class="p-6 flex flex-col flex-grow">
        <div class="flex justify-between items-start mb-3">
            @if($city_slug)
                <a href="{{ route('funeral-home-detail', ['citySlug' => $city_slug, 'funeralHomeSlug' => $slug]) }}" class="hover:text-purple-800 transition-colors duration-200">
                    <h3 class="font-playfair text-xl text-purple-700 leading-tight">{{ $name }}</h3>
                </a>
            @else
                <h3 class="font-playfair text-xl text-purple-700 leading-tight">{{ $name }}</h3>
            @endif
            @if($rating)
                <div class="flex items-center gap-1 bg-yellow-100 px-2 py-1 rounded-full">
                    <svg class="h-4 w-4 fill-yellow-500 text-yellow-500" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <span class="text-sm font-semibold text-yellow-800">{{ number_format($rating, 1) }}</span>
                    @if(isset($reviews_count) && $reviews_count > 0)
                        <span class="text-xs text-yellow-700">({{ $reviews_count }})</span>
                    @endif
                </div>
            @endif
        </div>
        <p class="text-gray-600 mb-4 flex-grow">{{ $description }}</p>
        
        @if(isset($categories) && count($categories) > 0)
            <div class="mb-4">
                <div class="flex flex-wrap gap-1">
                    @foreach(array_slice($categories, 0, 3) as $category)
                        <span class="px-2 py-1 bg-purple-100 text-purple-700 text-xs rounded-full">{{ $category }}</span>
                    @endforeach
                    @if(count($categories) > 3)
                        <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">+{{ count($categories) - 3 }}</span>
                    @endif
                </div>
            </div>
        @endif
        
        <div class="space-y-2 mb-4">
            <div class="flex items-center gap-2 text-sm text-gray-900">
                <svg class="h-4 w-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                @if($city_slug)
                    <a href="{{ route('city-funeral-homes', $city_slug) }}" class="text-green-600 hover:text-green-800 transition-colors duration-200 font-medium">
                        {{ $city }}
                    </a>
                @else
                    <span class="text-green-600 font-medium">{{ $city }}</span>
                @endif
                @if(isset($country_code) && $country_code)
                    <span class="text-gray-500">, {{ $country_code }}</span>
                @endif
            </div>
            @if($phone)
                <div class="flex items-center gap-2 text-sm text-gray-900">
                    <svg class="h-4 w-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span>{{ $phone }}</span>
                </div>
            @endif
        </div>
        
        <div class="mt-auto">
            @if($city_slug)
                <a href="{{ route('funeral-home-detail', ['citySlug' => $city_slug, 'funeralHomeSlug' => $slug]) }}">
                    <button class="w-full bg-gradient-to-r from-purple-600 to-purple-500 text-white py-3 rounded-lg font-medium hover:opacity-90 transition-all duration-300">
                        Ver Detalhes
                    </button>
                </a>
            @else
                <button class="w-full bg-gray-400 text-white py-3 rounded-lg font-medium cursor-not-allowed" disabled>
                    Indisponível
                </button>
            @endif
        </div>
    </div>
</div>
