import { Link, useLocation } from "react-router-dom";
import { Button } from "@/components/ui/button";
import logo from "@/assets/logo.png";

const Navbar = () => {
  const location = useLocation();
  
  const isActive = (path: string) => location.pathname === path;
  
  return (
    <nav className="fixed top-0 w-full bg-card/95 backdrop-blur-sm border-b border-border z-50 shadow-soft">
      <div className="container mx-auto px-4 h-20 flex items-center justify-between">
        <Link to="/" className="flex items-center gap-3 transition-smooth hover:opacity-80">
          <img src={logo} alt="Logo" className="h-12 w-12" />
          <span className="font-playfair text-2xl font-bold text-primary">
            Serviços Funerários
          </span>
        </Link>
        
        <div className="hidden md:flex items-center gap-8">
          <Link 
            to="/" 
            className={`text-sm font-medium transition-smooth hover:text-primary ${
              isActive('/') ? 'text-primary' : 'text-foreground'
            }`}
          >
            Início
          </Link>
          <Link 
            to="/funerarias" 
            className={`text-sm font-medium transition-smooth hover:text-primary ${
              isActive('/funerarias') ? 'text-primary' : 'text-foreground'
            }`}
          >
            Funerárias
          </Link>
          <Link 
            to="/quem-somos" 
            className={`text-sm font-medium transition-smooth hover:text-primary ${
              isActive('/quem-somos') ? 'text-primary' : 'text-foreground'
            }`}
          >
            Quem Somos
          </Link>
          <Button variant="default" size="sm" className="gradient-primary">
            Contactar
          </Button>
        </div>
      </div>
    </nav>
  );
};

export default Navbar;
