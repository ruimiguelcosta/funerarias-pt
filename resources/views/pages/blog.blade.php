@extends('layouts.app')

@section('content')
<div class="pt-20">
    <section class="relative py-20 bg-gradient-to-br from-purple-700 to-purple-500">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center text-white">
                <h1 class="font-playfair text-4xl md:text-5xl lg:text-6xl font-bold mb-6 animate-fade-in">
                    Blog de Serviços Funerários
                </h1>
                <p class="text-lg md:text-xl text-white/90 mb-8 animate-fade-in">
                    Informação útil, guias práticos e apoio para famílias em momentos difíceis
                </p>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            @if($posts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($posts as $post)
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

                <div class="flex justify-center">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <div class="w-24 h-24 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-5xl">📝</span>
                    </div>
                    <h2 class="font-playfair text-3xl font-bold text-gray-900 mb-4">
                        Ainda não há artigos publicados
                    </h2>
                    <p class="text-gray-600 text-lg mb-8 max-w-md mx-auto">
                        Estamos a preparar conteúdo de qualidade para si. Volte em breve!
                    </p>
                    <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-500 text-white font-semibold rounded-lg hover:opacity-90 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Voltar à Home
                    </a>
                </div>
            @endif
        </div>
    </section>

    @if($posts->count() > 0)
    <section class="py-16 bg-gradient-to-r from-purple-600 to-purple-500">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center text-white">
                <h2 class="font-playfair text-3xl md:text-4xl font-bold mb-4">
                    Precisa de Ajuda?
                </h2>
                <p class="text-lg text-white/90 mb-8">
                    Entre em contacto connosco para mais informações sobre serviços funerários
                </p>
                <a href="{{ route('contact') }}" class="inline-flex items-center px-8 py-4 bg-white text-purple-600 font-semibold rounded-lg hover:bg-gray-100 transition-all duration-300 shadow-lg">
                    <span>Contactar-nos</span>
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif
</div>
@endsection

