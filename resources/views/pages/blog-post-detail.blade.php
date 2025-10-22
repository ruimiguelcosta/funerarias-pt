@extends('layouts.app')

@section('title', 'Como Planear um Funeral com Dignidade - Serviços Funerários')

@section('content')
<div class="pt-20">
    <article class="container mx-auto px-4 py-12 max-w-4xl">
        <a href="{{ route('home') }}" class="inline-flex items-center text-gray-600 hover:text-purple-700 mb-6">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Voltar
        </a>

        <div class="mb-6">
            <span class="text-sm font-semibold text-yellow-800 px-3 py-1 rounded-full bg-yellow-100">
                Orientação
            </span>
        </div>

        <h1 class="font-playfair text-4xl md:text-5xl font-bold text-purple-700 mb-6">
            Como Planear um Funeral com Dignidade
        </h1>

        <div class="flex items-center gap-6 text-gray-600 mb-8">
            <span class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Maria Silva
            </span>
            <span class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                15 de Março, 2024
            </span>
        </div>

        <div class="aspect-video overflow-hidden rounded-lg mb-8">
            <img src="https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=800&h=500&fit=crop" 
                 alt="Como Planear um Funeral com Dignidade"
                 class="w-full h-full object-cover">
        </div>

        <div class="prose prose-lg max-w-none">
            <p class="text-gray-900 mb-4 leading-relaxed">
                Planear um funeral pode ser uma tarefa desafiadora, especialmente durante um período de luto. É importante ter em mente que cada detalhe conta para criar uma cerimónia que verdadeiramente honre a memória do seu ente querido.
            </p>
            <p class="text-gray-900 mb-4 leading-relaxed">
                Comece por escolher uma funerária de confiança que possa guiá-lo através de todas as etapas necessárias. Uma boa funerária oferece não apenas serviços profissionais, mas também apoio emocional durante este momento difícil.
            </p>
            <p class="text-gray-900 mb-4 leading-relaxed">
                Considere as preferências do falecido e da família ao escolher entre diferentes tipos de cerimónias. Seja uma cerimónia religiosa tradicional ou uma celebração mais personalizada da vida, o importante é que reflita os valores e a personalidade da pessoa que partiu.
            </p>
            <p class="text-gray-900 mb-4 leading-relaxed">
                Não hesite em pedir ajuda a amigos e familiares. O apoio da comunidade pode ser fundamental neste momento, tanto para questões práticas quanto para o conforto emocional.
            </p>
        </div>

        <div class="mt-12 pt-8 border-t">
            <h3 class="font-playfair text-2xl font-bold text-purple-700 mb-6">
                Posts Relacionados
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="#" class="group">
                    <div class="aspect-video overflow-hidden rounded-lg mb-3">
                        <img src="https://images.unsplash.com/photo-1584907797015-7554cd315667?w=800&h=500&fit=crop" 
                             alt="Tradições Funerárias em Portugal"
                             class="w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                    </div>
                    <h4 class="font-playfair text-lg font-semibold text-purple-700 group-hover:text-yellow-600 transition-colors">
                        Tradições Funerárias em Portugal
                    </h4>
                </a>
                
                <a href="#" class="group">
                    <div class="aspect-video overflow-hidden rounded-lg mb-3">
                        <img src="https://images.unsplash.com/photo-1519167758481-83f29da8c4f1?w=800&h=500&fit=crop" 
                             alt="Apoio no Processo de Luto"
                             class="w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                    </div>
                    <h4 class="font-playfair text-lg font-semibold text-purple-700 group-hover:text-yellow-600 transition-colors">
                        Apoio no Processo de Luto
                    </h4>
                </a>
            </div>
        </div>
    </article>
</div>
@endsection
