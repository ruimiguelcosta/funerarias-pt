import Navbar from '@/components/Navbar';
import { Heart, Users, Award, Shield } from 'lucide-react';
import { Footer } from '@/components/Footer';

const About = () => {
  return (
    <div className="min-h-screen bg-background">
      <Navbar />
      <div className="pt-20">
        <div 
          className="h-[400px] bg-cover bg-center relative"
          style={{ backgroundImage: `url(https://images.unsplash.com/photo-1584907797015-7554cd315667?w=800&h=400&fit=crop)` }}
        >
          <div className="absolute inset-0 gradient-hero" />
        </div>
        
        <section className="py-16">
          <div className="container mx-auto px-4">
            <div className="max-w-4xl mx-auto">
              <h1 className="font-playfair text-4xl md:text-5xl font-bold text-primary mb-8">
                Quem Somos
              </h1>
          
          <div className="prose prose-lg max-w-none">
            <p className="text-muted-foreground text-lg mb-8">
              Somos uma plataforma dedicada a conectar famílias com serviços funerários de qualidade e confiança em momentos de necessidade.
            </p>

            <section className="mb-12">
              <h2 className="font-playfair text-2xl font-semibold text-foreground mb-4">
                Nossa Missão
              </h2>
              <p className="text-muted-foreground">
                Nossa missão é proporcionar dignidade, respeito e apoio às famílias durante os momentos mais difíceis. 
                Conectamos você com funerárias profissionais que oferecem serviços compassivos e de alta qualidade, 
                garantindo que cada despedida seja realizada com a reverência que seus entes queridos merecem.
              </p>
            </section>

            <section className="grid md:grid-cols-2 gap-8 mb-12">
              <div className="bg-card p-6 rounded-lg border border-border">
                <Heart className="w-10 h-10 text-primary mb-4" />
                <h3 className="font-playfair text-xl font-semibold text-foreground mb-3">
                  Compaixão
                </h3>
                <p className="text-muted-foreground">
                  Entendemos a importância de oferecer suporte emocional e serviços que honrem a memória de seus entes queridos.
                </p>
              </div>

              <div className="bg-card p-6 rounded-lg border border-border">
                <Users className="w-10 h-10 text-primary mb-4" />
                <h3 className="font-playfair text-xl font-semibold text-foreground mb-3">
                  Parceiros de Confiança
                </h3>
                <p className="text-muted-foreground">
                  Trabalhamos apenas com funerárias certificadas e avaliadas, garantindo qualidade e profissionalismo.
                </p>
              </div>

              <div className="bg-card p-6 rounded-lg border border-border">
                <Award className="w-10 h-10 text-primary mb-4" />
                <h3 className="font-playfair text-xl font-semibold text-foreground mb-3">
                  Excelência
                </h3>
                <p className="text-muted-foreground">
                  Comprometemo-nos com os mais altos padrões de serviço em todos os aspectos da nossa plataforma.
                </p>
              </div>

              <div className="bg-card p-6 rounded-lg border border-border">
                <Shield className="w-10 h-10 text-primary mb-4" />
                <h3 className="font-playfair text-xl font-semibold text-foreground mb-3">
                  Transparência
                </h3>
                <p className="text-muted-foreground">
                  Fornecemos informações claras sobre serviços, preços e avaliações para ajudá-lo a tomar decisões informadas.
                </p>
              </div>
            </section>

            <section className="mb-12">
              <h2 className="font-playfair text-2xl font-semibold text-foreground mb-4">
                Nossa História
              </h2>
              <p className="text-muted-foreground mb-4">
                Fundada com o objetivo de facilitar o acesso a serviços funerários de qualidade, nossa plataforma nasceu 
                da necessidade de criar uma ponte entre famílias e funerárias profissionais em todo o país.
              </p>
              <p className="text-muted-foreground">
                Ao longo dos anos, temos ajudado milhares de famílias a encontrar os serviços adequados para homenagear 
                seus entes queridos com dignidade e respeito, tornando-nos uma referência no setor.
              </p>
            </section>

            <section>
              <h2 className="font-playfair text-2xl font-semibold text-foreground mb-4">
                Compromisso com Você
              </h2>
              <p className="text-muted-foreground">
                Estamos comprometidos em oferecer uma experiência que combine tecnologia, empatia e profissionalismo. 
                Nossa equipe trabalha constantemente para melhorar nossa plataforma e garantir que você encontre 
                exatamente o que precisa quando mais precisa.
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

export default About;
