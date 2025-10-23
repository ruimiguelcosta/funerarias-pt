<nav class="fixed top-0 w-full backdrop-blur-sm border-b z-50 shadow-sm" style="background-color: #D6C7DF; border-bottom-color: #B8A5C7;">
    <div class="container mx-auto px-4 h-20 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-3 transition-all duration-300 hover:opacity-80">
            <img src="{{ asset('images/logo.png') }}?v={{ time() }}" alt="Logo" class="h-12 w-auto object-contain">
        </a>

        <div class="hidden md:flex items-center gap-8">
            <a href="{{ route('home') }}"
               class="text-sm font-medium transition-all duration-300 hover:text-purple-800 {{ request()->routeIs('home') ? 'text-purple-800' : 'text-purple-700' }}">
                Início
            </a>
            <a href="{{ route('funeral-homes') }}"
               class="text-sm font-medium transition-all duration-300 hover:text-purple-800 {{ request()->routeIs('funeral-homes') ? 'text-purple-800' : 'text-purple-700' }}">
                Funerárias
            </a>
            <a href="{{ route('about') }}"
               class="text-sm font-medium transition-all duration-300 hover:text-purple-800 {{ request()->routeIs('about') ? 'text-purple-800' : 'text-purple-700' }}">
                Quem Somos
            </a>
            <button class="bg-gradient-to-r from-purple-600 to-purple-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:opacity-90 transition-all duration-300">
                Contactar
            </button>
        </div>
    </div>
</nav>
