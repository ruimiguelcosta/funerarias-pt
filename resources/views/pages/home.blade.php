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
            <div class="flex gap-4 justify-center animate-fade-in">
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
                @forelse($featuredFuneralHomes as $funeralHome)
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


    <!-- FAQ Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <h2 class="font-playfair text-4xl md:text-5xl font-bold text-purple-700 text-center mb-12">
                    Perguntas Frequentes
                </h2>

                <x-faq-section :faqs="[
                    [
                        'question' => 'Como escolher a melhor funerária?',
                        'answer' => 'Recomendamos verificar a reputação da funerária, ler avaliações de outros clientes, comparar preços e serviços oferecidos, e garantir que possuem todas as licenças necessárias. A nossa plataforma facilita esta comparação.'
                    ],
                    [
                        'question' => 'Quais serviços estão incluídos num funeral?',
                        'answer' => 'Os serviços básicos incluem transporte do corpo, preparação, velório, cerimónia e enterro ou cremação. Serviços adicionais podem incluir flores, música, catering e documentação legal.'
                    ],
                    [
                        'question' => 'Posso planear um funeral antecipadamente?',
                        'answer' => 'Sim, é possível e recomendado planear um funeral antecipadamente. Isto permite tomar decisões com calma e pode reduzir custos. Muitas funerárias oferecem planos de pré-pagamento.'
                    ],
                    [
                        'question' => 'Quanto custa um funeral em Portugal?',
                        'answer' => 'Os custos variam consoante os serviços escolhidos e a região. Um funeral básico pode custar entre 1.500€ a 3.000€, enquanto serviços mais completos podem custar 5.000€ ou mais.'
                    ],
                    [
                        'question' => 'Que documentos são necessários para um funeral?',
                        'answer' => 'São necessários o certificado de óbito, cartão de cidadão do falecido, comprovativo de residência e documentos de identificação dos familiares responsáveis pelo funeral.'
                    ]
                ]" />
            </div>
        </div>
    </section>

    <!-- Trust Indicators Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <h2 class="font-playfair text-4xl md:text-5xl font-bold text-purple-700 text-center mb-12">
                    Por Que Confiar na Nossa Plataforma
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
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

                    <div class="text-center bg-white p-6 rounded-lg shadow-sm">
                        <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl">📞</span>
                        </div>
                        <h3 class="font-playfair text-lg font-semibold text-gray-900 mb-2">
                            Apoio 24/7
                        </h3>
                        <p class="text-gray-600 text-sm">
                            Equipa de apoio disponível para ajudar em qualquer momento
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
