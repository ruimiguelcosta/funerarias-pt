@extends('layouts.app')

@section('content')
<div class="pt-20">
    <x-breadcrumbs :items="[
        ['label' => 'Início', 'url' => '/'],
        ['label' => 'Pesquisa']
    ]" />

    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center mb-10">
                <h1 class="font-playfair text-4xl md:text-5xl font-bold text-purple-700 mb-4">{{ __('search.title') }}</h1>
                <p class="text-gray-600">{{ __('search.subtitle') }}</p>
            </div>

            <form method="GET" action="{{ route('search.results') }}" class="max-w-3xl mx-auto" data-behavior="native">
                <div class="flex gap-3">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="{{ __('search.placeholder') }}" class="w-full border rounded-lg px-4 py-3" required minlength="2" />
                    <button type="submit" class="bg-gradient-to-r from-purple-600 to-purple-500 text-white px-6 py-3 rounded-lg font-medium shadow-soft hover:opacity-90 transition">{{ __('search.button') }}</button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection


