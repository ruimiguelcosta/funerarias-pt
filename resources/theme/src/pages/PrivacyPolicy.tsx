import Navbar from '@/components/Navbar';
import { Footer } from '@/components/Footer';

const PrivacyPolicy = () => {
  return (
    <div className="min-h-screen bg-background">
      <Navbar />
      <div className="pt-20">
        <div 
          className="h-[400px] bg-cover bg-center relative"
          style={{ backgroundImage: `url(https://images.unsplash.com/photo-1519167758481-83f29da8c4f1?w=800&h=400&fit=crop)` }}
        >
          <div className="absolute inset-0 gradient-hero" />
        </div>
        
        <section className="py-16">
          <div className="container mx-auto px-4">
            <div className="max-w-4xl mx-auto">
              <h1 className="font-playfair text-4xl md:text-5xl font-bold text-primary mb-8">
                Política de Privacidade
              </h1>
          
          <div className="prose prose-lg max-w-none text-muted-foreground">
            <p className="text-lg mb-8">
              Última atualização: {new Date().toLocaleDateString('pt-PT')}
            </p>

            <section className="mb-8">
              <h2 className="font-playfair text-2xl font-semibold text-foreground mb-4">
                Introdução
              </h2>
              <p>
                A sua privacidade é importante para nós. Esta Política de Privacidade explica como recolhemos, 
                utilizamos, divulgamos e protegemos as suas informações quando visita o nosso website e utiliza 
                os nossos serviços.
              </p>
            </section>

            <section className="mb-8">
              <h2 className="font-playfair text-2xl font-semibold text-foreground mb-4">
                Informações que Recolhemos
              </h2>
              <p className="mb-4">Podemos recolher as seguintes categorias de informações:</p>
              
              <div className="space-y-4">
                <div>
                  <h3 className="text-xl font-semibold text-foreground mb-2">
                    Informações Pessoais
                  </h3>
                  <p>
                    Nome, endereço de e-mail, número de telefone e outras informações de contacto que nos fornece 
                    voluntariamente quando utiliza os nossos serviços.
                  </p>
                </div>

                <div>
                  <h3 className="text-xl font-semibold text-foreground mb-2">
                    Informações de Utilização
                  </h3>
                  <p>
                    Informações sobre como utiliza o nosso website, incluindo páginas visitadas, tempo de permanência, 
                    e outras estatísticas de utilização.
                  </p>
                </div>

                <div>
                  <h3 className="text-xl font-semibold text-foreground mb-2">
                    Informações Técnicas
                  </h3>
                  <p>
                    Endereço IP, tipo de navegador, sistema operativo, e outras informações técnicas recolhidas 
                    automaticamente quando acede ao nosso website.
                  </p>
                </div>
              </div>
            </section>

            <section className="mb-8">
              <h2 className="font-playfair text-2xl font-semibold text-foreground mb-4">
                Como Utilizamos as Suas Informações
              </h2>
              <p className="mb-4">Utilizamos as informações recolhidas para:</p>
              <ul className="list-disc pl-6 space-y-2">
                <li>Fornecer, operar e manter os nossos serviços</li>
                <li>Melhorar, personalizar e expandir os nossos serviços</li>
                <li>Compreender e analisar como utiliza o nosso website</li>
                <li>Desenvolver novos produtos, serviços e funcionalidades</li>
                <li>Comunicar consigo, diretamente ou através de parceiros</li>
                <li>Processar as suas transações e pedidos</li>
                <li>Prevenir fraudes e atividades ilegais</li>
                <li>Cumprir obrigações legais</li>
              </ul>
            </section>

            <section className="mb-8">
              <h2 className="font-playfair text-2xl font-semibold text-foreground mb-4">
                Partilha de Informações
              </h2>
              <p className="mb-4">
                Podemos partilhar as suas informações nas seguintes circunstâncias:
              </p>
              <ul className="list-disc pl-6 space-y-2">
                <li>Com funerárias parceiras para fornecer os serviços solicitados</li>
                <li>Com prestadores de serviços terceiros que nos auxiliam nas nossas operações</li>
                <li>Para cumprir obrigações legais ou responder a processos legais</li>
                <li>Para proteger os direitos, propriedade ou segurança da nossa empresa ou utilizadores</li>
                <li>Com o seu consentimento ou mediante a sua solicitação</li>
              </ul>
            </section>

            <section className="mb-8">
              <h2 className="font-playfair text-2xl font-semibold text-foreground mb-4">
                Segurança das Informações
              </h2>
              <p>
                Implementamos medidas de segurança técnicas e organizacionais adequadas para proteger as suas 
                informações pessoais contra acesso não autorizado, alteração, divulgação ou destruição. No entanto, 
                nenhum método de transmissão pela Internet ou de armazenamento eletrónico é 100% seguro.
              </p>
            </section>

            <section className="mb-8">
              <h2 className="font-playfair text-2xl font-semibold text-foreground mb-4">
                Os Seus Direitos
              </h2>
              <p className="mb-4">Tem o direito de:</p>
              <ul className="list-disc pl-6 space-y-2">
                <li>Aceder às informações pessoais que detemos sobre si</li>
                <li>Solicitar a correção de informações incorretas ou incompletas</li>
                <li>Solicitar a eliminação das suas informações pessoais</li>
                <li>Opor-se ou restringir o processamento das suas informações</li>
                <li>Retirar o consentimento a qualquer momento</li>
                <li>Apresentar uma reclamação junto da autoridade de proteção de dados</li>
              </ul>
            </section>

            <section className="mb-8">
              <h2 className="font-playfair text-2xl font-semibold text-foreground mb-4">
                Retenção de Dados
              </h2>
              <p>
                Retemos as suas informações pessoais apenas pelo tempo necessário para cumprir as finalidades 
                descritas nesta política, a menos que um período de retenção mais longo seja exigido ou permitido 
                por lei.
              </p>
            </section>

            <section className="mb-8">
              <h2 className="font-playfair text-2xl font-semibold text-foreground mb-4">
                Links para Outros Websites
              </h2>
              <p>
                O nosso website pode conter links para websites de terceiros. Não somos responsáveis pelas práticas 
                de privacidade desses websites. Recomendamos que leia as políticas de privacidade de todos os 
                websites que visita.
              </p>
            </section>

            <section className="mb-8">
              <h2 className="font-playfair text-2xl font-semibold text-foreground mb-4">
                Alterações a Esta Política
              </h2>
              <p>
                Podemos atualizar esta Política de Privacidade periodicamente. Notificaremos sobre quaisquer 
                alterações publicando a nova política nesta página e atualizando a data de "Última atualização".
              </p>
            </section>

            <section>
              <h2 className="font-playfair text-2xl font-semibold text-foreground mb-4">
                Contacto
              </h2>
              <p>
                Se tiver questões ou preocupações sobre esta Política de Privacidade ou as nossas práticas de 
                dados, por favor contacte-nos através dos meios disponíveis no nosso website.
              </p>
            </section>
          </div>
            </div>
          </div>
        </section>
      </div>
      
      <Footer />
    </div>
  );
};

export default PrivacyPolicy;
