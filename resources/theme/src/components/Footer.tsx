import { Link } from 'react-router-dom';

export const Footer = () => {
  return (
    <footer className="bg-card border-t border-border mt-16">
      <div className="container mx-auto px-4 py-12">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div>
            <h3 className="font-playfair text-lg font-semibold text-foreground mb-4">
              Sobre Nós
            </h3>
            <p className="text-muted-foreground text-sm">
              Conectando famílias com serviços funerários de qualidade e confiança.
            </p>
          </div>
          
          <div>
            <h3 className="font-playfair text-lg font-semibold text-foreground mb-4">
              Links Rápidos
            </h3>
            <ul className="space-y-2 text-sm">
              <li>
                <Link to="/" className="text-muted-foreground hover:text-primary transition-colors">
                  Início
                </Link>
              </li>
              <li>
                <Link to="/funerarias" className="text-muted-foreground hover:text-primary transition-colors">
                  Funerárias
                </Link>
              </li>
              <li>
                <Link to="/quem-somos" className="text-muted-foreground hover:text-primary transition-colors">
                  Quem Somos
                </Link>
              </li>
            </ul>
          </div>
          
          <div>
            <h3 className="font-playfair text-lg font-semibold text-foreground mb-4">
              Informações Legais
            </h3>
            <ul className="space-y-2 text-sm">
              <li>
                <Link to="/politica-privacidade" className="text-muted-foreground hover:text-primary transition-colors">
                  Política de Privacidade
                </Link>
              </li>
              <li>
                <Link to="/politica-cookies" className="text-muted-foreground hover:text-primary transition-colors">
                  Política de Cookies
                </Link>
              </li>
            </ul>
          </div>
        </div>
        
        <div className="border-t border-border mt-8 pt-8 text-center text-sm text-muted-foreground">
          <p>© {new Date().getFullYear()} Funerárias Portugal. Todos os direitos reservados.</p>
        </div>
      </div>
    </footer>
  );
};
