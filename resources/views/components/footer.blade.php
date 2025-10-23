<footer class="bg-white border-t border-gray-200 mt-16">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="font-playfair text-lg font-semibold text-gray-900 mb-4">
                    Sobre Nós
                </h3>
                <p class="text-gray-600 text-sm">
                    Conectando famílias com serviços funerários de qualidade e confiança.
                </p>
            </div>
            
            <div>
                <h3 class="font-playfair text-lg font-semibold text-gray-900 mb-4">
                    Links Rápidos
                </h3>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-purple-700 transition-colors">
                            Início
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('funeral-homes') }}" class="text-gray-600 hover:text-purple-700 transition-colors">
                            Funerárias
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="text-gray-600 hover:text-purple-700 transition-colors">
                            Quem Somos
                        </a>
                    </li>
                </ul>
            </div>
            
            <div>
                <h3 class="font-playfair text-lg font-semibold text-gray-900 mb-4">
                    Informações Legais
                </h3>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="{{ route('privacy-policy') }}" class="text-gray-600 hover:text-purple-700 transition-colors">
                            Política de Privacidade
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cookie-policy') }}" class="text-gray-600 hover:text-purple-700 transition-colors">
                            Política de Cookies
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('terms') }}" class="text-gray-600 hover:text-purple-700 transition-colors">
                            Termos e Condições
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-200 mt-8 pt-8 text-center text-sm text-gray-600">
            <p>© {{ date('Y') }} Funerárias Portugal. Todos os direitos reservados.</p>
        </div>
    </div>
</footer>
