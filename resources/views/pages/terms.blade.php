@extends('layouts.app')

@section('title', 'Termos e Condições - Serviços Funerários')

@section('content')
<div class="pt-20">
    <div class="h-[400px] bg-cover bg-center relative" 
         style="background-image: url('https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=800&h=400&fit=crop')">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-800/95 to-purple-600/90"></div>
    </div>
    
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <h1 class="font-playfair text-4xl md:text-5xl font-bold text-purple-700 mb-8">
                    Termos e Condições
                </h1>
        
                <div class="prose prose-lg max-w-none text-gray-600">
                    <p class="text-lg mb-8">
                        Última atualização: {{ date('d/m/Y') }}
                    </p>

                    <section class="mb-8">
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            Aceitação dos Termos
                        </h2>
                        <p>
                            Ao aceder e utilizar este website, aceita e concorda em estar vinculado aos seguintes 
                            Termos e Condições de Utilização. Se não concordar com qualquer parte destes termos, 
                            não deverá utilizar este website.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            Utilização do Website
                        </h2>
                        <p class="mb-4">
                            Este website foi criado para fornecer informações sobre serviços funerários em Portugal 
                            e para facilitar a localização de funerárias. Ao utilizar este website, compromete-se a:
                        </p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li>Utilizar o website apenas para fins legais e legítimos</li>
                            <li>Não utilizar o website de forma que possa danificar, desativar, sobrecarregar ou prejudicar o serviço</li>
                            <li>Não tentar obter acesso não autorizado ao website, a sistemas ou redes relacionados</li>
                            <li>Não utilizar qualquer robot, spider, ou outro dispositivo automático para aceder ao website</li>
                            <li>Não transmitir qualquer material ilegal, ofensivo, difamatório ou que viole direitos de terceiros</li>
                        </ul>
                    </section>

                    <section class="mb-8">
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            Informações Fornecidas
                        </h2>
                        <p>
                            Embora nos esforcemos para garantir que todas as informações apresentadas no website sejam 
                            precisas e atualizadas, não garantimos a exatidão, completude ou adequação dessas informações. 
                            As informações sobre funerárias, serviços, horários e contactos são fornecidas pelas próprias 
                            funerárias ou obtidas de fontes públicas. Recomendamos que confirme sempre as informações 
                            diretamente com a funerária antes de tomar qualquer decisão.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            Direitos Autorais e Propriedade Intelectual
                        </h2>
                        <p class="mb-4">
                            Todo o conteúdo presente neste website, incluindo mas não se limitando a textos, gráficos, 
                            logotipos, ícones, imagens, clipes de áudio, downloads digitais e compilações de dados, 
                            é propriedade do website ou dos seus fornecedores de conteúdo e está protegido por leis 
                            portuguesas e internacionais de direitos autorais.
                        </p>
                        <p class="mb-4">É proibido:</p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li>Reproduzir, duplicar, copiar, vender ou explorar comercialmente qualquer parte do website sem autorização expressa</li>
                            <li>Modificar, adaptar ou criar obras derivadas do conteúdo do website</li>
                            <li>Remover quaisquer avisos de direitos autorais ou outros avisos de propriedade</li>
                            <li>Utilizar o conteúdo do website para fins comerciais sem autorização prévia</li>
                        </ul>
                        <p class="mt-4">
                            As marcas comerciais, logotipos e marcas de serviço exibidos no website são propriedade das 
                            respetivas funerárias e entidades. A utilização destas marcas sem autorização é estritamente 
                            proibida.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            Avaliações e Comentários
                        </h2>
                        <p class="mb-4">
                            Os utilizadores podem submeter avaliações e comentários sobre funerárias. Ao submeter conteúdo, 
                            concede-nos uma licença não exclusiva, transferível, isenta de royalties, perpétua e irrevogável 
                            para usar, reproduzir, modificar, adaptar e publicar esse conteúdo.
                        </p>
                        <p class="mb-4">Ao submeter avaliações, compromete-se a:</p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li>Fornecer informações verdadeiras e baseadas na sua experiência pessoal</li>
                            <li>Não publicar conteúdo difamatório, ofensivo ou ilegal</li>
                            <li>Não violar direitos de propriedade intelectual ou privacidade de terceiros</li>
                            <li>Não publicar conteúdo que contenha vírus ou códigos maliciosos</li>
                        </ul>
                        <p class="mt-4">
                            Reservamo-nos o direito de remover ou editar qualquer conteúdo submetido que consideremos 
                            inadequado, ofensivo ou que viole estes termos.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            Links para Websites de Terceiros
                        </h2>
                        <p>
                            Este website pode conter links para websites de terceiros, incluindo websites de funerárias 
                            parceiras. Estes links são fornecidos apenas para conveniência. Não temos controlo sobre o 
                            conteúdo desses websites e não somos responsáveis pelo seu conteúdo, práticas de privacidade 
                            ou disponibilidade. A inclusão de qualquer link não implica endosso do website por nós.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            Limitação de Responsabilidade
                        </h2>
                        <p class="mb-4">
                            Na medida máxima permitida por lei, não seremos responsáveis por quaisquer danos diretos, 
                            indiretos, incidentais, especiais, consequenciais ou punitivos, incluindo mas não se limitando a:
                        </p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li>Perda de lucros, receitas ou dados</li>
                            <li>Interrupção de negócios</li>
                            <li>Perda de oportunidades comerciais</li>
                            <li>Danos resultantes da utilização ou incapacidade de utilizar o website</li>
                            <li>Danos resultantes de qualquer serviço ou produto adquirido através do website</li>
                        </ul>
                    </section>

                    <section class="mb-8">
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            Isenção de Garantias
                        </h2>
                        <p>
                            O website é fornecido "como está" e "conforme disponível", sem garantias de qualquer tipo, 
                            expressas ou implícitas. Não garantimos que o website será ininterrupto, seguro ou livre de 
                            erros, nem que os defeitos serão corrigidos. Não garantimos a precisão, fiabilidade ou 
                            completude de qualquer informação ou conteúdo disponível no website.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            Modificações dos Termos
                        </h2>
                        <p>
                            Reservamo-nos o direito de modificar estes Termos e Condições a qualquer momento. As 
                            alterações entrarão em vigor imediatamente após a sua publicação no website. A continuação 
                            da utilização do website após a publicação de alterações constitui a sua aceitação dessas 
                            alterações. Recomendamos que reveja periodicamente estes termos.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            Lei Aplicável e Jurisdição
                        </h2>
                        <p>
                            Estes Termos e Condições são regidos e interpretados de acordo com as leis de Portugal. 
                            Qualquer disputa relacionada com estes termos será submetida à jurisdição exclusiva dos 
                            tribunais portugueses.
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            Reclamações e Resolução de Litígios
                        </h2>
                        <p class="mb-4">
                            Se tiver alguma reclamação ou preocupação sobre o website, os seus serviços ou conteúdo, 
                            encorajamos a contactar-nos primeiro para tentarmos resolver a questão de forma amigável.
                        </p>
                        
                        <div class="bg-purple-50 border border-purple-200 rounded-lg p-6 mt-4">
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">
                                Contactos para Reclamações
                            </h3>
                            <div class="space-y-2 text-gray-700">
                                <p>
                                    <strong>Email:</strong> 
                                    <a href="mailto:reclamacoes@servicosfunerarios.pt" class="text-purple-600 hover:text-purple-700">
                                        reclamacoes@servicosfunerarios.pt
                                    </a>
                                </p>
                                <p>
                                    <strong>Telefone:</strong> 
                                    <a href="tel:+351800000000" class="text-purple-600 hover:text-purple-700">
                                        +351 800 000 000
                                    </a>
                                </p>
                                <p class="mt-4 text-sm">
                                    Responderemos à sua reclamação no prazo de 10 dias úteis. Se não ficar satisfeito 
                                    com a nossa resposta, pode recorrer aos meios de resolução alternativa de litígios 
                                    ou apresentar uma reclamação junto das autoridades competentes.
                                </p>
                            </div>
                        </div>

                        <p class="mt-4">
                            <strong>Entidade de Resolução Alternativa de Litígios:</strong><br>
                            Centro de Arbitragem de Conflitos de Consumo<br>
                            Website: <a href="https://www.cniacc.pt/" class="text-purple-600 hover:text-purple-700" target="_blank" rel="noopener">www.cniacc.pt</a>
                        </p>

                        <p class="mt-4">
                            <strong>Livro de Reclamações Eletrónico:</strong><br>
                            Pode apresentar a sua reclamação através do Livro de Reclamações Eletrónico em 
                            <a href="https://www.livroreclamacoes.pt/" class="text-purple-600 hover:text-purple-700" target="_blank" rel="noopener">www.livroreclamacoes.pt</a>
                        </p>
                    </section>

                    <section class="mb-8">
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            Contacto Geral
                        </h2>
                        <p class="mb-4">
                            Para questões sobre estes Termos e Condições ou sobre o website em geral, pode contactar-nos através de:
                        </p>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                            <p class="mb-2">
                                <strong>Email:</strong> 
                                <a href="mailto:info@servicosfunerarios.pt" class="text-purple-600 hover:text-purple-700">
                                    info@servicosfunerarios.pt
                                </a>
                            </p>
                            <p class="mb-2">
                                <strong>Telefone:</strong> 
                                <a href="tel:+351800000000" class="text-purple-600 hover:text-purple-700">
                                    +351 800 000 000
                                </a>
                            </p>
                            <p>
                                <strong>Horário de Atendimento:</strong> Segunda a Sexta, das 9h às 18h
                            </p>
                        </div>
                    </section>

                    <section>
                        <h2 class="font-playfair text-2xl font-semibold text-gray-900 mb-4">
                            Disposições Gerais
                        </h2>
                        <p class="mb-4">
                            Se qualquer disposição destes Termos e Condições for considerada inválida ou inexequível, 
                            essa disposição será limitada ou eliminada na medida mínima necessária, e as restantes 
                            disposições permanecerão em pleno vigor e efeito.
                        </p>
                        <p>
                            A falha em exercer ou fazer cumprir qualquer direito ou disposição destes termos não 
                            constituirá uma renúncia a esse direito ou disposição.
                        </p>
                    </section>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

