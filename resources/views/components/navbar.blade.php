<nav class="fixed top-0 w-full bg-white/95 backdrop-blur-sm border-b border-gray-200 z-50 shadow-sm">
    <div class="container mx-auto px-4 h-20 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-3 transition-all duration-300 hover:opacity-80">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-12">
            <span class="font-playfair text-2xl font-bold text-purple-700">
                Serviços Funerários
            </span>
        </a>
        
        <div class="hidden md:flex items-center gap-8">
            <a href="{{ route('home') }}" 
               class="text-sm font-medium transition-all duration-300 hover:text-purple-700 {{ request()->routeIs('home') ? 'text-purple-700' : 'text-gray-900' }}">
                Início
            </a>
            <a href="{{ route('funeral-homes') }}" 
               class="text-sm font-medium transition-all duration-300 hover:text-purple-700 {{ request()->routeIs('funeral-homes') ? 'text-purple-700' : 'text-gray-900' }}">
                Funerárias
            </a>
            <a href="{{ route('about') }}" 
               class="text-sm font-medium transition-all duration-300 hover:text-purple-700 {{ request()->routeIs('about') ? 'text-purple-700' : 'text-gray-900' }}">
                Quem Somos
            </a>
            <button class="bg-gradient-to-r from-purple-600 to-purple-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:opacity-90 transition-all duration-300">
                Contactar
            </button>
        </div>
    </div>
</nav>
