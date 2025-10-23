@extends('layouts.app')

@section('content')
<div class="pt-20">
    <!-- Breadcrumbs -->
    <x-breadcrumbs :items="[
        ['label' => 'Início', 'url' => '/'],
        ['label' => 'Contactos']
    ]" />
    
    <!-- Hero Section -->
    <div class="h-[400px] bg-cover bg-center relative" 
         style="background-image: url('https://images.unsplash.com/photo-1502082553048-f009c37129b9?w=800&h=400&fit=crop')">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-800/60 to-purple-600/50"></div>
    </div>
    
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <h1 class="font-playfair text-4xl md:text-5xl font-bold text-purple-700 mb-4">
                        Contacte-nos
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Estamos aqui para ajudar. Entre em contacto connosco para qualquer questão ou esclarecimento sobre os nossos serviços.
                    </p>
                </div>
                
                <!-- Formulário de Contacto -->
                <div class="max-w-2xl mx-auto">
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-6">
                            Envie-nos uma Mensagem
                        </h2>
                        
                        <form class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nome Completo *
                                </label>
                                <input type="text" id="name" name="name" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200">
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email *
                                </label>
                                <input type="email" id="email" name="email" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200">
                            </div>
                            
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    Telefone
                                </label>
                                <input type="tel" id="phone" name="phone"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200">
                            </div>
                            
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                                    Assunto *
                                </label>
                                <select id="subject" name="subject" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200">
                                    <option value="">Selecione um assunto</option>
                                    <option value="informacao">Informação sobre serviços</option>
                                    <option value="duvida">Dúvida sobre funerária</option>
                                    <option value="sugestao">Sugestão</option>
                                    <option value="reclamacao">Reclamação</option>
                                    <option value="outro">Outro</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                    Mensagem *
                                </label>
                                <textarea id="message" name="message" rows="5" required
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200 resize-vertical"
                                          placeholder="Escreva aqui a sua mensagem..."></textarea>
                            </div>
                            
                            <div class="flex items-start gap-3">
                                <input type="checkbox" id="privacy" name="privacy" required
                                       class="mt-1 h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                <label for="privacy" class="text-sm text-gray-600">
                                    Concordo com a <a href="{{ route('privacy-policy') }}" target="_blank" class="text-purple-600 hover:text-purple-700 underline">Política de Privacidade</a> e autorizo o tratamento dos meus dados pessoais. *
                                </label>
                            </div>
                            
                            <button type="submit"
                                    class="w-full bg-gradient-to-r from-purple-600 to-purple-500 text-white py-3 px-6 rounded-lg font-semibold hover:opacity-90 transition-all duration-300 shadow-lg hover:shadow-xl">
                                Enviar Mensagem
                            </button>
                        </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
