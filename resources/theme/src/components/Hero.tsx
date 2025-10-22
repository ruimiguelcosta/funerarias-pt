import { Button } from "@/components/ui/button";
import { Link } from "react-router-dom";
import heroImage from "@/assets/hero-bg.jpg";

const Hero = () => {
  return (
    <section className="relative min-h-[600px] flex items-center justify-center overflow-hidden">
      <div 
        className="absolute inset-0 bg-cover bg-center"
        style={{ backgroundImage: `url(${heroImage})` }}
      />
      <div className="absolute inset-0 gradient-hero" />
      
      <div className="container mx-auto px-4 relative z-10 text-center">
        <h1 className="font-playfair text-5xl md:text-6xl lg:text-7xl font-bold text-primary-foreground mb-6 animate-fade-in">
          Dignidade e Respeito
          <br />
          <span className="text-secondary">em Momentos Difíceis</span>
        </h1>
        <p className="text-lg md:text-xl text-primary-foreground/90 max-w-2xl mx-auto mb-8 animate-fade-in">
          Encontre os melhores serviços funerários com profissionalismo, 
          compaixão e dedicação à sua família.
        </p>
        <div className="flex gap-4 justify-center animate-fade-in">
          <Link to="/funerarias">
            <Button size="lg" className="gradient-secondary text-secondary-foreground font-semibold hover:opacity-90 transition-smooth">
              Ver Funerárias
            </Button>
          </Link>
          <Button size="lg" variant="hero">
            Saber Mais
          </Button>
        </div>
      </div>
    </section>
  );
};

export default Hero;
