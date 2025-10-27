@extends('layouts.app')

@section('content')
<div class="pt-20">
    <!-- Breadcrumbs -->
    <x-breadcrumbs :items="[
        ['label' => 'Início', 'url' => '/'],
        ['label' => 'Funerárias']
    ]" />

    <!-- Hero Section -->
    <div class="relative">
        <x-hero-image 
            :src="asset('images/cruzes.jpg')"
            alt="Todas as funerárias em Portugal"
            class="h-[400px] w-full object-cover"
            size="large"
            :priority="true"
        />
        <div class="absolute inset-0 bg-gradient-to-br from-purple-800/95 to-purple-600/20"></div>
    </div>

    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h1 class="font-playfair text-4xl md:text-5xl lg:text-6xl font-bold text-purple-700 mb-4">
                    Todas as Funerárias
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Encontre o serviço funerário ideal para sua família com dignidade,
                    respeito e profissionalismo.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @forelse($entities as $entity)
                    @include('components.funeral-home-card', [
                        'id' => $entity->id,
                        'name' => $entity->title,
                        'slug' => $entity->slug,
                        'city_slug' => $entity->city_slug,
                        'city' => $entity->city,
                        'country_code' => $entity->country_code,
                        'location' => $entity->city ? $entity->city . ', ' . $entity->country_code : 'Portugal',
                        'phone' => $entity->phone,
                        'rating' => $entity->total_score,
                        'description' => $entity->description ? Str::limit($entity->description, 120) : 'Serviços funerários com tradição e respeito.',
                        'image' => $entity->images->where('category', 'main')->first()?->local_url ??
                                  $entity->images->first()?->local_url ??
                                  'https://images.unsplash.com/photo-1584907797015-7554cd315667?w=400&h=300&fit=crop',
                        'categories' => $entity->categories->pluck('name')->toArray(),
                        'reviews_count' => $entity->reviews_count
                    ])
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 text-lg">Nenhuma funerária encontrada.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($entities->hasPages())
                <div class="mt-12">
                    <x-pagination :paginator="$entities" />
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
