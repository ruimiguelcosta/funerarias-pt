<div id="cookie-consent" class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg p-4 z-50 animate-fade-in" style="display: none;">
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="text-sm text-gray-600">
            <p>
                Utilizamos cookies para melhorar a sua experiência. Ao continuar a navegar, concorda com a nossa
                <a href="{{ route('cookie-policy') }}" class="text-purple-700 hover:underline">
                    Política de Cookies
                </a>
                e
                <a href="{{ route('privacy-policy') }}" class="text-purple-700 hover:underline">
                    Política de Privacidade
                </a>
                .
            </p>
        </div>
        <div class="flex gap-3">
            <button onclick="declineCookies()" class="border border-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-50 transition-all duration-300">
                Recusar
            </button>
            <button onclick="acceptCookies()" class="bg-purple-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:opacity-90 transition-all duration-300">
                Aceitar
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const consent = localStorage.getItem('cookie-consent');
        if (!consent) {
            document.getElementById('cookie-consent').style.display = 'block';
        }
    });

    function acceptCookies() {
        localStorage.setItem('cookie-consent', 'accepted');
        document.getElementById('cookie-consent').style.display = 'none';
    }

    function declineCookies() {
        localStorage.setItem('cookie-consent', 'declined');
        document.getElementById('cookie-consent').style.display = 'none';
    }
</script>
