@extends('layouts.app')

@section('content')
<div class="pt-20">
    <!-- Breadcrumbs -->
    <x-breadcrumbs :items="[
        ['label' => 'Início', 'url' => '/'],
        ['label' => 'Funerárias', 'url' => '/funerarias'],
        ['label' => $funeralHome->city, 'url' => route('city-funeral-homes', $funeralHome->city_slug)],
        ['label' => $funeralHome->title]
    ]" />

    <!-- Hero Section -->
    <div class="h-[400px] bg-cover bg-center relative"
         style="background-image: url('{{ $funeralHome->images->where('category', 'main')->first()?->local_url ?? $funeralHome->images->first()?->local_url ?? 'https://images.unsplash.com/photo-1584907797015-7554cd315667?w=800&h=400&fit=crop' }}')">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-800/95 to-purple-600/30"></div>
    </div>

    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h1 class="font-playfair text-4xl md:text-5xl font-bold text-purple-700 mb-4">
                            {{ $funeralHome->title }}
                        </h1>
                        @if($funeralHome->sub_title)
                        <p class="text-lg text-gray-600">{{ $funeralHome->sub_title }}</p>
                        @endif
                    </div>
                    @if($funeralHome->total_score)
                    <div class="flex items-center gap-2 bg-yellow-100 px-4 py-2 rounded-full">
                        <svg class="h-5 w-5 fill-yellow-500 text-yellow-500" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span class="text-xl font-bold text-yellow-800">{{ $funeralHome->total_score }}</span>
                        @if($funeralHome->reviews_count)
                        <span class="text-sm text-gray-600">({{ $funeralHome->reviews_count }} avaliações)</span>
                        @endif
                    </div>
                    @endif
                </div>

                <div class="bg-white rounded-lg border border-gray-200 mb-8 p-6">
                    <h2 class="font-playfair text-2xl text-purple-700 mb-4">
                        Informações de Contacto
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if($funeralHome->address)
                        <div class="flex items-start gap-3">
                            <svg class="h-5 w-5 text-green-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <div>
                                <p class="font-semibold text-gray-900">Morada</p>
                                <p class="text-gray-600">{{ $funeralHome->address }}</p>
                                @if($funeralHome->postal_code)
                                <p class="text-gray-600">{{ $funeralHome->postal_code }} {{ $funeralHome->city }}</p>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($funeralHome->phone)
                        <div class="flex items-start gap-3">
                            <svg class="h-5 w-5 text-green-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <div>
                                <p class="font-semibold text-gray-900">Telefone</p>
                                <p class="text-gray-600">{{ $funeralHome->phone }}</p>
                            </div>
                        </div>
                        @endif

                        @if($funeralHome->website)
                        <div class="flex items-start gap-3">
                            <svg class="h-5 w-5 text-green-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <div>
                                <p class="font-semibold text-gray-900">Website</p>
                                <a href="{{ $funeralHome->website }}" target="_blank" class="text-purple-600 hover:text-purple-800">{{ $funeralHome->website }}</a>
                            </div>
                        </div>
                        @endif

                        <div class="flex items-start gap-3">
                            <svg class="h-5 w-5 text-green-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="font-semibold text-gray-900">Horário</p>
                                <p class="text-gray-600">Disponível 24 horas</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Funeral Home Description Card -->
                @if($funeralHome->generated_description)
                <div class="bg-white rounded-lg border border-gray-200 mb-8 p-6">
                    <h2 class="font-playfair text-2xl text-purple-700 mb-4">
                        Sobre Esta Funerária
                    </h2>
                    <div class="prose prose-lg max-w-none">
                        <div class="text-gray-700 leading-relaxed whitespace-pre-line">
                            {{ $funeralHome->generated_description }}
                        </div>
                    </div>
                </div>
                @else
                <!-- Fallback description if no AI-generated description exists -->
                <div class="bg-white rounded-lg border border-gray-200 mb-8 p-6">
                    <h2 class="font-playfair text-2xl text-purple-700 mb-4">
                        Sobre Esta Funerária
                    </h2>
                    <div class="prose prose-lg max-w-none">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Esta funerária oferece serviços completos e personalizados para apoiar as famílias durante momentos difíceis.
                            Com uma equipa experiente e dedicada, garantimos que cada serviço seja realizado com o máximo respeito,
                            dignidade e profissionalismo.
                        </p>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Os nossos serviços incluem organização completa de cerimónias fúnebres, transporte, preparação e todos os
                            procedimentos necessários para honrar a memória dos seus entes queridos. Estamos comprometidos em
                            proporcionar conforto e apoio durante este período sensível.
                        </p>
                        <div class="bg-purple-50 border-l-4 border-purple-400 p-4 mt-6">
                            <p class="text-purple-800 font-medium mb-2">💙 Compromisso com a Excelência</p>
                            <p class="text-purple-700 text-sm">
                                Trabalhamos com transparência, compaixão e atenção aos detalhes,
                                garantindo que cada família receba o cuidado e respeito que merece.
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- About Us Card -->
                @if($funeralHome->description)
                <div class="bg-white rounded-lg border border-gray-200 mb-12 p-6">
                    <h2 class="font-playfair text-3xl text-purple-700 mb-4">
                        Sobre Nós
                    </h2>
                    <p class="text-gray-900 text-lg leading-relaxed">
                        {{ $funeralHome->description }}
                    </p>
                </div>
                @endif

                <!-- Categories -->
                @if($funeralHome->categories->count() > 0)
                <div class="bg-white rounded-lg border border-gray-200 mb-12 p-6">
                    <h2 class="font-playfair text-2xl text-purple-700 mb-4">
                        Serviços Oferecidos
                    </h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($funeralHome->categories as $category)
                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm">
                            {{ $category->name }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Reviews Section -->
                <x-reviews-section :reviews="$funeralHome->reviews" :funeral-home="$funeralHome" />

                <div class="mt-12 text-center">
                    <a href="tel:{{ $funeralHome->phone }}" class="bg-gradient-to-r from-purple-600 to-purple-500 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:opacity-90 transition-all duration-300 inline-block">
                        Contactar Agora
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
