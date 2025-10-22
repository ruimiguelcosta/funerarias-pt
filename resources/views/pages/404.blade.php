@extends('layouts.app')

@section('title', 'Página Não Encontrada - Serviços Funerários')

@section('content')
<div class="flex min-h-screen items-center justify-center bg-gray-50">
    <div class="text-center">
        <h1 class="mb-4 text-6xl font-bold text-purple-700">404</h1>
        <p class="mb-4 text-xl text-gray-600">Oops! Página não encontrada</p>
        <p class="mb-8 text-gray-500">A página que procura não existe ou foi movida.</p>
        <a href="{{ route('home') }}" class="bg-gradient-to-r from-purple-600 to-purple-500 text-white px-6 py-3 rounded-lg font-medium hover:opacity-90 transition-all duration-300">
            Voltar ao Início
        </a>
    </div>
</div>
@endsection
