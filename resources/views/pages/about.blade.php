@extends('layouts.app')

@section('content')
<div class="pt-20">
    <x-breadcrumbs :items="[
        ['label' => __('pages.breadcrumbs.home'), 'url' => '/'],
        ['label' => __('pages.breadcrumbs.about')]
    ]" />

    <div class="relative">
        <x-hero-image 
            :src="asset('images/cemiterio.jpg')"
            alt="{{ __('pages.about.hero_alt') }}"
            class="h-[400px] w-full object-cover"
            size="large"
            :priority="true"
        />
        <div class="absolute inset-0 bg-gradient-to-br from-purple-800/60 to-purple-600/20"></div>
    </div>

    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <h1 class="font-playfair text-4xl md:text-5xl font-bold text-purple-700 mb-8">
                    {{ __('pages.about.title') }}
                </h1>

                <div class="prose prose-lg max-w-none">
                    <p class="text-gray-600 text-lg mb-8">
                        {{ __('pages.about.intro') }}
                    </p>

                    <section class="mb-12">
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            {{ __('pages.about.mission_title') }}
                        </h2>
                        <p class="text-gray-600">
                            {{ __('pages.about.mission_text') }}
                        </p>
                    </section>

                    <section class="grid md:grid-cols-2 gap-8 mb-12">
                        <div class="bg-white p-6 rounded-lg border border-gray-200">
                            <div class="w-10 h-10 text-purple-600 mb-4">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h3 class="font-playfair text-xl font-semibold text-gray-900 mb-3">
                                {{ __('pages.about.card_compassion_title') }}
                            </h3>
                            <p class="text-gray-600">
                                {{ __('pages.about.card_compassion_text') }}
                            </p>
                        </div>

                        <div class="bg-white p-6 rounded-lg border border-gray-200">
                            <div class="w-10 h-10 text-purple-600 mb-4">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                </svg>
                            </div>
                            <h3 class="font-playfair text-xl font-semibold text-gray-900 mb-3">
                                {{ __('pages.about.card_partners_title') }}
                            </h3>
                            <p class="text-gray-600">
                                {{ __('pages.about.card_partners_text') }}
                            </p>
                        </div>

                        <div class="bg-white p-6 rounded-lg border border-gray-200">
                            <div class="w-10 h-10 text-purple-600 mb-4">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                            </div>
                            <h3 class="font-playfair text-xl font-semibold text-gray-900 mb-3">
                                {{ __('pages.about.card_excellence_title') }}
                            </h3>
                            <p class="text-gray-600">
                                {{ __('pages.about.card_excellence_text') }}
                            </p>
                        </div>

                        <div class="bg-white p-6 rounded-lg border border-gray-200">
                            <div class="w-10 h-10 text-purple-600 mb-4">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <h3 class="font-playfair text-xl font-semibold text-gray-900 mb-3">
                                {{ __('pages.about.card_transparency_title') }}
                            </h3>
                            <p class="text-gray-600">
                                {{ __('pages.about.card_transparency_text') }}
                            </p>
                        </div>
                    </section>

                    <section class="mb-12">
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            {{ __('pages.about.history_title') }}
                        </h2>
                        <p class="text-gray-600 mb-4">
                            {{ __('pages.about.history_text_1') }}
                        </p>
                        <p class="text-gray-600">
                            {{ __('pages.about.history_text_2') }}
                        </p>
                    </section>

                    <section>
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            {{ __('pages.about.commitment_title') }}
                        </h2>
                        <p class="text-gray-600">
                            {{ __('pages.about.commitment_text') }}
                        </p>
                    </section>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
