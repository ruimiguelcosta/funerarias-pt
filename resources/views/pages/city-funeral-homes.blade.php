@extends('layouts.app')

@section('content')
<div class="pt-20">
    <!-- Breadcrumbs -->
    <x-breadcrumbs :items="[
        ['label' => 'Início', 'url' => '/'],
        ['label' => 'Funerárias', 'url' => route('funeral-homes')],
        ['label' => $city->city]
    ]" />
    
    <!-- Hero Section -->
    <div class="h-[400px] bg-cover bg-center relative" 
         style="background-image: url('https://images.unsplash.com/photo-1502082553048-f009c37129b9?w=800&h=400&fit=crop')">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-800/95 to-purple-600/90"></div>
    </div>
    
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h1 class="font-playfair text-4xl md:text-5xl lg:text-6xl font-bold text-purple-700 mb-4">
                    Funerárias em {{ $city->city }}
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Encontre os melhores serviços funerários em {{ $city->city }} com dignidade, 
                    respeito e profissionalismo.
                </p>
                <div class="mt-4 text-sm text-gray-500">
                    {{ $funeralHomes->total() }} {{ $funeralHomes->total() == 1 ? 'funerária encontrada' : 'funerárias encontradas' }}
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @forelse($funeralHomes as $funeralHome)
                    @include('components.funeral-home-card', [
                        'id' => $funeralHome->id,
                        'name' => $funeralHome->title,
                        'slug' => $funeralHome->slug,
                        'city_slug' => $funeralHome->city_slug,
                        'city' => $funeralHome->city,
                        'country_code' => $funeralHome->country_code,
                        'location' => $funeralHome->city ? $funeralHome->city . ', ' . $funeralHome->country_code : 'Portugal',
                        'phone' => $funeralHome->phone,
                        'rating' => $funeralHome->total_score,
                        'description' => $funeralHome->description ? Str::limit($funeralHome->description, 120) : 'Serviços funerários com tradição e respeito.',
                        'image' => $funeralHome->images->where('category', 'main')->first()?->local_url ?? 
                                  $funeralHome->images->first()?->local_url ?? 
                                  'https://images.unsplash.com/photo-1584907797015-7554cd315667?w=400&h=300&fit=crop',
                        'categories' => $funeralHome->categories->pluck('name')->toArray(),
                        'reviews_count' => $funeralHome->reviews_count
                    ])
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 text-lg">Nenhuma funerária encontrada em {{ $city->city }}.</p>
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            @if($funeralHomes->hasPages())
                <div class="flex justify-center">
                    {{ $funeralHomes->links() }}
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
