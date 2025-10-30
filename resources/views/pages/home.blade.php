@extends('layouts.app')

@section('content')
<div class="pt-20">
    <section class="relative min-h-[600px] flex items-center justify-center overflow-hidden">
        <picture>
            <source srcset="{{ asset('images/home-large.avif') }}" type="image/avif">
            <source srcset="{{ asset('images/home-large.webp') }}" type="image/webp">
            <img
                src="{{ asset('images/home.jpg') }}"
                alt="Serviços funerários com dignidade e respeito"
                class="absolute inset-0 w-full h-full object-cover"
                width="1200"
                height="800"
                fetchpriority="high"
                loading="eager"
                decoding="async"
            >
        </picture>
        <div class="absolute inset-0 bg-gradient-to-br from-purple-800/95 to-purple-600/20"></div>

        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="font-playfair text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 animate-fade-in">
                Dignidade e Respeito
                <br />
                <span class="text-yellow-300">em Momentos Difíceis</span>
            </h1>
            <p class="text-lg md:text-xl text-white/90 max-w-2xl mx-auto mb-8 animate-fade-in">
                Encontre os melhores serviços funerários com profissionalismo,
                compaixão e dedicação à sua família.
            </p>
            <form method="GET" action="{{ route('search.results') }}" class="max-w-3xl mx-auto animate-fade-in" data-behavior="native">
                <div class="flex gap-3">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="{{ __('search.placeholder_home') }}" class="w-full border border-white bg-transparent text-white placeholder-white rounded-lg px-4 py-4 text-lg" required minlength="2" />
                    <button type="submit" class="bg-yellow-400 text-gray-900 px-6 py-4 rounded-lg text-lg font-semibold hover:bg-yellow-500 transition">{{ __('search.button') }}</button>
                </div>
            </form>
            <div class="flex gap-4 justify-center mt-6 animate-fade-in">
                <a href="{{ route('funeral-homes') }}">
                    <button class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 px-8 py-4 rounded-lg text-lg font-semibold hover:opacity-90 transition-all duration-300">
                        Ver Funerárias
                    </button>
                </a>
                <a href="{{ route('about') }}">
                    <button class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white hover:text-purple-700 transition-all duration-300">
                        Saber Mais
                    </button>
                </a>
            </div>
        </div>
    </section>

    <!-- Nearby Funeral Homes Section -->
    <section id="nearby-funeral-homes-section" class="py-20 bg-gradient-to-br from-purple-50 to-white hidden">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h2 class="font-playfair text-4xl md:text-5xl font-bold text-purple-700 mb-4">
                    Funerárias Perto de Si
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Encontramos estas funerárias nas proximidades da sua localização,
                    ordenadas por distância para facilitar o seu acesso.
                </p>
            </div>

            <div id="nearby-loading" class="text-center py-12 hidden">
                <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-purple-600"></div>
                <p class="mt-4 text-gray-600">A carregar funerárias próximas...</p>
            </div>

            <div id="nearby-funeral-homes-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('nearby-map') }}"
                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-600 to-green-500 text-white font-semibold rounded-lg hover:opacity-90 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                    </svg>
                    <span>Ver Funerárias Próximas no Mapa</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Funeral Homes Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="font-playfair text-4xl md:text-5xl font-bold text-purple-700 mb-4">
                    Funerárias de Confiança
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Selecionamos as melhores funerárias com serviços de excelência
                    para apoiar sua família neste momento.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($featuredEntities as $entity)
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
                        <p class="text-gray-500 text-lg">Nenhuma funerária em destaque encontrada.</p>
                    </div>
                @endforelse
            </div>

            <!-- Link para todas as funerárias -->
            <div class="text-center mt-12">
                <a href="{{ route('funeral-homes') }}"
                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-purple-600 to-purple-500 text-white font-semibold rounded-lg hover:opacity-90 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <span>Ver Todas as Funerárias</span>
                    <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-20 bg-gradient-to-br from-white to-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <h2 class="font-playfair text-4xl md:text-5xl font-bold text-purple-700 text-center mb-12">
                    Por Que Escolher-nos
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl">🕊️</span>
                        </div>
                        <h3 class="font-playfair text-xl font-semibold text-purple-700 mb-2">
                            Dignidade
                        </h3>
                        <p class="text-gray-600">
                            Tratamos cada família com o máximo respeito e dignidade.
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl">💛</span>
                        </div>
                        <h3 class="font-playfair text-xl font-semibold text-purple-700 mb-2">
                            Compaixão
                        </h3>
                        <p class="text-gray-600">
                            Apoio emocional e compreensão em momentos difíceis.
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl">⭐</span>
                        </div>
                        <h3 class="font-playfair text-xl font-semibold text-purple-700 mb-2">
                            Excelência
                        </h3>
                        <p class="text-gray-600">
                            Serviços de qualidade superior com atenção aos detalhes.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Blog Section -->
    @if($featuredPosts->count() > 0)
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="font-playfair text-4xl md:text-5xl font-bold text-purple-700 mb-4">
                    Artigos Recentes
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Informação útil e guias práticos sobre serviços funerários em Portugal
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredPosts as $post)
                    <x-blog-post-card
                        :id="$post->id"
                        :title="$post->title"
                        :slug="$post->slug"
                        :excerpt="$post->meta_description ?? Str::limit(strip_tags($post->description ?? ''), 150)"
                        :image="$post->image"
                        :category="$post->category"
                        :date="$post->used_at ? $post->used_at->format('d M Y') : $post->created_at->format('d M Y')"
                        :readTime="'5 min'"
                    />
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('blog') }}"
                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-purple-600 to-purple-500 text-white font-semibold rounded-lg hover:opacity-90 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <span>Ver Todos os Artigos</span>
                    <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- FAQ Section -->
    @if($faqs->isNotEmpty())
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <h2 class="font-playfair text-4xl md:text-5xl font-bold text-purple-700 text-center mb-12">
                    {{ site_setting('faq.title', 'Perguntas Frequentes') }}
                </h2>

                <x-faq-section :faqs="$faqs" />
            </div>
        </div>
    </section>

    <!-- Trust Indicators Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <h2 class="font-playfair text-4xl md:text-5xl font-bold text-purple-700 text-center mb-12">
                    Por Que Confiar na Nossa Plataforma
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                    <div class="text-center bg-white p-6 rounded-lg shadow-sm">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl">✓</span>
                        </div>
                        <h3 class="font-playfair text-lg font-semibold text-gray-900 mb-2">
                            Funerárias Verificadas
                        </h3>
                        <p class="text-gray-600 text-sm">
                            Todas as funerárias são verificadas e possuem licenças válidas
                        </p>
                    </div>

                    <div class="text-center bg-white p-6 rounded-lg shadow-sm">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl">⭐</span>
                        </div>
                        <h3 class="font-playfair text-lg font-semibold text-gray-900 mb-2">
                            Avaliações Reais
                        </h3>
                        <p class="text-gray-600 text-sm">
                            Avaliações autênticas de famílias que utilizaram os serviços
                        </p>
                    </div>

                    <div class="text-center bg-white p-6 rounded-lg shadow-sm">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl">🔒</span>
                        </div>
                        <h3 class="font-playfair text-lg font-semibold text-gray-900 mb-2">
                            Dados Protegidos
                        </h3>
                        <p class="text-gray-600 text-sm">
                            Seus dados pessoais são protegidos com máxima segurança
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endif
@endsection
