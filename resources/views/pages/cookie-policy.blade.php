@extends('layouts.app')

@section('title', 'Política de Cookies - Serviços Funerários')

@section('content')
<div class="pt-20">
    <!-- Hero Section -->
    <div class="h-[400px] bg-cover bg-center relative" 
         style="background-image: url('https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=800&h=400&fit=crop')">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-800/95 to-purple-600/90"></div>
    </div>
    
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <h1 class="font-playfair text-4xl md:text-5xl font-bold text-purple-700 mb-8">
                    Política de Cookies
                </h1>
        
                <div class="prose prose-lg max-w-none text-gray-600">
                    <p class="text-lg mb-8">
                        Última atualização: {{ date('d/m/Y') }}
                    </p>

                    <section class="mb-8">
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            Conformidade Legal
                        </h2>
                        <p class="mb-4">
                            Esta Política de Cookies está em conformidade com o Regulamento Geral sobre a Proteção de Dados (RGPD) 
                            da União Europeia e com as diretrizes da Diretiva ePrivacy. Também seguimos as políticas e requisitos 
                            estabelecidos pelo Google para a utilização de cookies e tecnologias de publicidade.
                        </p>
                        <p>
                            Ao utilizar o nosso website, concorda com a utilização de cookies de acordo com esta política. 
                            Se não concordar com a utilização de cookies, deverá configurar o seu navegador em conformidade 
                            ou abster-se de utilizar este website.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            O que são Cookies?
                        </h2>
                        <p>
                            Cookies são pequenos ficheiros de texto que são colocados no seu dispositivo quando visita o nosso website. 
                            Estes ficheiros permitem-nos reconhecer o seu dispositivo e armazenar algumas informações sobre as suas 
                            preferências ou ações anteriores.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            Como Utilizamos os Cookies?
                        </h2>
                        <p class="mb-4">Utilizamos cookies para diversos fins, incluindo:</p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li>Melhorar a funcionalidade e desempenho do nosso website</li>
                            <li>Personalizar a sua experiência de navegação</li>
                            <li>Analisar como os visitantes utilizam o nosso website</li>
                            <li>Recordar as suas preferências e configurações</li>
                            <li>Garantir a segurança do website</li>
                        </ul>
                    </section>

                    <section class="mb-8">
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            Tipos de Cookies que Utilizamos
                        </h2>
                        
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                    Cookies Essenciais
                                </h3>
                                <p>
                                    Estes cookies são necessários para o funcionamento básico do website e não podem ser desativados. 
                                    Incluem cookies que permitem a navegação básica e acesso a áreas seguras.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                    Cookies de Desempenho
                                </h3>
                                <p>
                                    Estes cookies recolhem informações sobre como os visitantes utilizam o website, permitindo-nos 
                                    melhorar o seu funcionamento e identificar problemas.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                    Cookies de Funcionalidade
                                </h3>
                                <p>
                                    Permitem que o website se lembre das escolhas que faz (como nome de utilizador ou idioma) 
                                    e forneça funcionalidades melhoradas e mais personalizadas.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                    Cookies Analíticos
                                </h3>
                                <p>
                                    Utilizamos estes cookies para compreender como os visitantes interagem com o nosso website, 
                                    ajudando-nos a melhorar a experiência do utilizador.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                    Cookies de Publicidade e Marketing
                                </h3>
                                <p>
                                    Estes cookies são utilizados para apresentar anúncios relevantes aos visitantes e para medir 
                                    a eficácia das campanhas publicitárias. Incluem cookies do Google AdSense e de outros parceiros 
                                    publicitários que nos ajudam a financiar e manter este website. Estes cookies podem rastrear 
                                    a sua navegação em diferentes websites para criar um perfil dos seus interesses e apresentar 
                                    anúncios personalizados.
                                </p>
                            </div>
                        </div>
                    </section>

                    <section class="mb-8">
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            Gestão de Cookies
                        </h2>
                        <p class="mb-4">
                            Pode controlar e/ou eliminar cookies conforme desejar. Pode eliminar todos os cookies que já estão 
                            no seu dispositivo e pode configurar a maioria dos navegadores para impedir que sejam colocados.
                        </p>
                        <p>
                            No entanto, se o fizer, poderá ter que ajustar manualmente algumas preferências sempre que visitar 
                            um website e alguns serviços e funcionalidades poderão não funcionar.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            Cookies de Terceiros
                        </h2>
                        <p class="mb-4">
                            Em alguns casos, utilizamos cookies fornecidos por terceiros de confiança. Os cookies de terceiros 
                            são utilizados para fins analíticos, de melhoria da experiência do utilizador e para apresentação 
                            de publicidade relevante.
                        </p>

                        <div class="bg-purple-50 border-l-4 border-purple-600 p-6 mb-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">
                                Google AdSense e Cookies Publicitários
                            </h3>
                            <p class="mb-4">
                                Este website utiliza o Google AdSense, um serviço de publicidade fornecido pela Google LLC. 
                                O Google AdSense utiliza cookies e outras tecnologias de rastreamento para:
                            </p>
                            <ul class="list-disc pl-6 space-y-2 mb-4">
                                <li>Apresentar anúncios relevantes baseados nas suas visitas anteriores ao nosso website</li>
                                <li>Apresentar anúncios baseados nas suas visitas a outros websites na Internet</li>
                                <li>Medir a eficácia dos anúncios e a interação dos utilizadores</li>
                                <li>Prevenir a exibição repetida dos mesmos anúncios</li>
                            </ul>
                            <p class="mb-4">
                                O Google e os seus parceiros utilizam cookies para apresentar anúncios com base nas visitas 
                                anteriores do utilizador a este ou outros websites. A utilização de cookies de publicidade 
                                permite ao Google e aos seus parceiros apresentar anúncios aos utilizadores com base na sua 
                                visita a este site e/ou a outros sites na Internet.
                            </p>
                            <p class="mb-4">
                                <strong class="text-gray-900">Gestão de Preferências de Anúncios:</strong><br>
                                Pode desativar a utilização de cookies para publicidade personalizada visitando as 
                                <a href="https://www.google.com/settings/ads" 
                                   target="_blank" 
                                   rel="noopener noreferrer" 
                                   class="text-purple-700 hover:underline font-medium">
                                    Definições de Anúncios do Google
                                </a>. 
                                Alternativamente, pode desativar a utilização de cookies de terceiros para publicidade 
                                personalizada visitando 
                                <a href="https://www.aboutads.info" 
                                   target="_blank" 
                                   rel="noopener noreferrer" 
                                   class="text-purple-700 hover:underline font-medium">
                                    www.aboutads.info
                                </a>.
                            </p>
                            <p>
                                Para mais informações sobre como o Google utiliza dados quando utiliza websites ou 
                                aplicações dos nossos parceiros, consulte a página 
                                <a href="https://policies.google.com/technologies/ads" 
                                   target="_blank" 
                                   rel="noopener noreferrer" 
                                   class="text-purple-700 hover:underline font-medium">
                                    Como a Google utiliza dados quando utiliza sites ou aplicações dos nossos parceiros
                                </a>.
                            </p>
                        </div>

                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">
                                Outros Serviços de Terceiros
                            </h3>
                            <p>
                                Além do Google AdSense, podemos utilizar outros serviços de terceiros que também 
                                colocam cookies no seu dispositivo, incluindo serviços de análise e ferramentas 
                                de monitorização de desempenho. Estes serviços têm as suas próprias políticas de 
                                privacidade e cookies.
                            </p>
                        </div>
                    </section>

                    <section class="mb-8">
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            Alterações a Esta Política
                        </h2>
                        <p>
                            Podemos atualizar esta Política de Cookies periodicamente para refletir mudanças nas nossas práticas 
                            ou por outros motivos operacionais, legais ou regulamentares.
                        </p>
                    </section>

                    <section>
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            Contacto
                        </h2>
                        <p>
                            Se tiver alguma questão sobre a nossa utilização de cookies, por favor contacte-nos através dos 
                            meios disponíveis no nosso website.
                        </p>
                    </section>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
