<footer class="bg-white border-t border-gray-200 mt-16">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="font-playfair text-lg font-semibold text-gray-900 mb-4">
                    {{ __('footer.about_title') }}
                </h3>
                <p class="text-gray-600 text-sm">
                    {{ __('footer.about_text') }}
                </p>
            </div>
            
            <div>
                <h3 class="font-playfair text-lg font-semibold text-gray-900 mb-4">
                    {{ __('footer.quick_links') }}
                </h3>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-purple-700 transition-colors">
                            {{ __('nav.home') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('funeral-homes') }}" class="text-gray-600 hover:text-purple-700 transition-colors">
                            {{ __('nav.funeral_homes') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="text-gray-600 hover:text-purple-700 transition-colors">
                            {{ __('nav.about') }}
                        </a>
                    </li>
                </ul>
            </div>
            
            <div>
                <h3 class="font-playfair text-lg font-semibold text-gray-900 mb-4">
                    {{ __('footer.legal') }}
                </h3>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="{{ route('privacy-policy') }}" class="text-gray-600 hover:text-purple-700 transition-colors">
                            {{ __('footer.privacy') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cookie-policy') }}" class="text-gray-600 hover:text-purple-700 transition-colors">
                            {{ __('footer.cookies') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('terms') }}" class="text-gray-600 hover:text-purple-700 transition-colors">
                            {{ __('footer.terms') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-200 mt-8 pt-8 text-center text-sm text-gray-600">
            <p>{{ __('footer.copyright', ['year' => date('Y')]) }}</p>
        </div>
    </div>
</footer>
