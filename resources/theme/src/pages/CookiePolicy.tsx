import Navbar from '@/components/Navbar';
import { Footer } from '@/components/Footer';

const CookiePolicy = () => {
  return (
    <div className="min-h-screen bg-background">
      <Navbar />
      <div className="pt-20">
        <div 
          className="h-[400px] bg-cover bg-center relative"
          style={{ backgroundImage: `url(https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=800&h=400&fit=crop)` }}
        >
          <div className="absolute inset-0 gradient-hero" />
        </div>
        
        <section className="py-16">
          <div className="container mx-auto px-4">
            <div className="max-w-4xl mx-auto">
              <h1 className="font-playfair text-4xl md:text-5xl font-bold text-primary mb-8">
                Política de Cookies
              </h1>
          
          <div className="prose prose-lg max-w-none text-muted-foreground">
            <p className="text-lg mb-8">
              Última atualização: {new Date().toLocaleDateString('pt-PT')}
            </p>

            <section className="mb-8">
              <h2 className="font-playfair text-2xl font-semibold text-foreground mb-4">
                O que são Cookies?
              </h2>
              <p>
                Cookies são pequenos ficheiros de texto que são colocados no seu dispositivo quando visita o nosso website. 
                Estes ficheiros permitem-nos reconhecer o seu dispositivo e armazenar algumas informações sobre as suas 
                preferências ou ações anteriores.
              </p>
            </section>

            <section className="mb-8">
              <h2 className="font-playfair text-2xl font-semibold text-foreground mb-4">
                Como Utilizamos os Cookies?
              </h2>
              <p className="mb-4">Utilizamos cookies para diversos fins, incluindo:</p>
              <ul className="list-disc pl-6 space-y-2">
                <li>Melhorar a funcionalidade e desempenho do nosso website</li>
                <li>Personalizar a sua experiência de navegação</li>
                <li>Analisar como os visitantes utilizam o nosso website</li>
                <li>Recordar as suas preferências e configurações</li>
                <li>Garantir a segurança do website</li>
              </ul>
            </section>

            <section className="mb-8">
              <h2 className="font-playfair text-2xl font-semibold text-foreground mb-4">
                Tipos de Cookies que Utilizamos
              </h2>
              
              <div className="space-y-6">
                <div>
                  <h3 className="text-xl font-semibold text-foreground mb-2">
                    Cookies Essenciais
                  </h3>
                  <p>
                    Estes cookies são necessários para o funcionamento básico do website e não podem ser desativados. 
                    Incluem cookies que permitem a navegação básica e acesso a áreas seguras.
                  </p>
                </div>

                <div>
                  <h3 className="text-xl font-semibold text-foreground mb-2">
                    Cookies de Desempenho
                  </h3>
                  <p>
                    Estes cookies recolhem informações sobre como os visitantes utilizam o website, permitindo-nos 
                    melhorar o seu funcionamento e identificar problemas.
                  </p>
                </div>

                <div>
                  <h3 className="text-xl font-semibold text-foreground mb-2">
                    Cookies de Funcionalidade
                  </h3>
                  <p>
                    Permitem que o website se lembre das escolhas que faz (como nome de utilizador ou idioma) 
                    e forneça funcionalidades melhoradas e mais personalizadas.
                  </p>
                </div>

                <div>
                  <h3 className="text-xl font-semibold text-foreground mb-2">
                    Cookies Analíticos
                  </h3>
                  <p>
                    Utilizamos estes cookies para compreender como os visitantes interagem com o nosso website, 
                    ajudando-nos a melhorar a experiência do utilizador.
                  </p>
                </div>
              </div>
            </section>

            <section className="mb-8">
              <h2 className="font-playfair text-2xl font-semibold text-foreground mb-4">
                Gestão de Cookies
              </h2>
              <p className="mb-4">
                Pode controlar e/ou eliminar cookies conforme desejar. Pode eliminar todos os cookies que já estão 
                no seu dispositivo e pode configurar a maioria dos navegadores para impedir que sejam colocados.
              </p>
              <p>
                No entanto, se o fizer, poderá ter que ajustar manualmente algumas preferências sempre que visitar 
                um website e alguns serviços e funcionalidades poderão não funcionar.
              </p>
            </section>

            <section className="mb-8">
              <h2 className="font-playfair text-2xl font-semibold text-foreground mb-4">
                Cookies de Terceiros
              </h2>
              <p>
                Em alguns casos, utilizamos cookies fornecidos por terceiros de confiança. Os cookies de terceiros 
                são utilizados para fins analíticos e de melhoria da experiência do utilizador.
              </p>
            </section>

            <section className="mb-8">
              <h2 className="font-playfair text-2xl font-semibold text-foreground mb-4">
                Alterações a Esta Política
              </h2>
              <p>
                Podemos atualizar esta Política de Cookies periodicamente para refletir mudanças nas nossas práticas 
                ou por outros motivos operacionais, legais ou regulamentares.
              </p>
            </section>

            <section>
              <h2 className="font-playfair text-2xl font-semibold text-foreground mb-4">
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
      
      <Footer />
    </div>
  );
};

export default CookiePolicy;
