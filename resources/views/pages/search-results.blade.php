@extends('layouts.app')

@section('content')
<div class="pt-20">
    <x-breadcrumbs :items="[
        ['label' => 'Início', 'url' => '/'],
        ['label' => 'Pesquisa', 'url' => route('search')],
        ['label' => 'Resultados']
    ]" />

    <section class="py-10">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto mb-8">
                <form method="GET" action="{{ route('search.results') }}" class="flex gap-3" data-behavior="native">
                    <input type="text" name="q" value="{{ $q }}" placeholder="{{ __('search.placeholder') }}" class="w-full border rounded-lg px-4 py-3" required minlength="2" />
                    <button type="submit" class="bg-gradient-to-r from-purple-600 to-purple-500 text-white px-6 py-3 rounded-lg font-medium shadow-soft hover:opacity-90 transition">{{ __('search.button') }}</button>
                </form>
                <p class="mt-3 text-gray-600">{{ __('search.results_for') }} <span class="font-medium">{{ $q }}</span></p>
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
                        <p class="text-gray-500 text-lg">{{ __('search.no_results') }}</p>
                    </div>
                @endforelse
            </div>

            @if($entities->hasPages())
                <div class="mt-12">
                    <x-pagination :paginator="$entities" />
                </div>
            @endif
        </div>
    </section>
</div>
@endsection


