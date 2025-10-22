import { useState } from "react";
import Navbar from "@/components/Navbar";
import FuneralHomeCard from "@/components/FuneralHomeCard";
import { Footer } from "@/components/Footer";
import {
  Pagination,
  PaginationContent,
  PaginationItem,
  PaginationLink,
  PaginationNext,
  PaginationPrevious,
} from "@/components/ui/pagination";

const allFuneralHomes = [
  {
    id: 1,
    name: "Funerária Paz Eterna",
    location: "Lisboa, Portugal",
    phone: "+351 21 123 4567",
    rating: 4.9,
    description: "Serviços funerários completos com tradição e respeito há mais de 50 anos.",
    image: "https://images.unsplash.com/photo-1584907797015-7554cd315667?w=400&h=300&fit=crop"
  },
  {
    id: 2,
    name: "Serviços Funerários Luz",
    location: "Porto, Portugal",
    phone: "+351 22 987 6543",
    rating: 4.8,
    description: "Dedicação e profissionalismo em cada momento, apoiando famílias com compaixão.",
    image: "https://images.unsplash.com/photo-1519167758481-83f29da8c4f1?w=400&h=300&fit=crop"
  },
  {
    id: 3,
    name: "Funerária Serenidade",
    location: "Coimbra, Portugal",
    phone: "+351 23 456 7890",
    rating: 4.7,
    description: "Cuidado personalizado e atenção aos detalhes para honrar seus entes queridos.",
    image: "https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=400&h=300&fit=crop"
  },
  {
    id: 4,
    name: "Funerária Harmonia",
    location: "Braga, Portugal",
    phone: "+351 25 333 2222",
    rating: 4.9,
    description: "Compromisso com a excelência e apoio integral às famílias enlutadas.",
    image: "https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=300&fit=crop"
  },
  {
    id: 5,
    name: "Serviços Memorial",
    location: "Faro, Portugal",
    phone: "+351 28 444 5555",
    rating: 4.6,
    description: "Tradição familiar com serviços personalizados e atendimento 24 horas.",
    image: "https://images.unsplash.com/photo-1470252649378-9c29740c9fa8?w=400&h=300&fit=crop"
  },
  {
    id: 6,
    name: "Funerária Esperança",
    location: "Évora, Portugal",
    phone: "+351 26 555 6666",
    rating: 4.8,
    description: "Serviço humanizado com respeito às tradições e culturas de cada família.",
    image: "https://images.unsplash.com/photo-1502082553048-f009c37129b9?w=400&h=300&fit=crop"
  }
];

const FuneralHomes = () => {
  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 6;
  
  const totalPages = Math.ceil(allFuneralHomes.length / itemsPerPage);
  const startIndex = (currentPage - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  const currentHomes = allFuneralHomes.slice(startIndex, endIndex);
  
  const handlePageChange = (page: number) => {
    setCurrentPage(page);
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };
  
  return (
    <div className="min-h-screen bg-background">
      <Navbar />
      <div className="pt-20">
        <div 
          className="h-[400px] bg-cover bg-center relative"
          style={{ backgroundImage: `url(https://images.unsplash.com/photo-1502082553048-f009c37129b9?w=800&h=400&fit=crop)` }}
        >
          <div className="absolute inset-0 gradient-hero" />
        </div>
        
        <section className="py-16">
          <div className="container mx-auto px-4">
            <div className="text-center mb-12">
              <h1 className="font-playfair text-4xl md:text-5xl lg:text-6xl font-bold text-primary mb-4">
                Todas as Funerárias
              </h1>
              <p className="text-lg text-muted-foreground max-w-2xl mx-auto">
                Encontre o serviço funerário ideal para sua família com dignidade, 
                respeito e profissionalismo.
              </p>
            </div>
            
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
              {currentHomes.map((home) => (
                <FuneralHomeCard key={home.id} {...home} />
              ))}
            </div>
            
            <Pagination className="mb-8">
              <PaginationContent>
                <PaginationItem>
                  <PaginationPrevious 
                    onClick={() => currentPage > 1 && handlePageChange(currentPage - 1)}
                    className={currentPage === 1 ? "pointer-events-none opacity-50" : "cursor-pointer"}
                  />
                </PaginationItem>
                
                {Array.from({ length: totalPages }, (_, i) => i + 1).map((page) => (
                  <PaginationItem key={page}>
                    <PaginationLink
                      onClick={() => handlePageChange(page)}
                      isActive={currentPage === page}
                      className="cursor-pointer"
                    >
                      {page}
                    </PaginationLink>
                  </PaginationItem>
                ))}
                
                <PaginationItem>
                  <PaginationNext 
                    onClick={() => currentPage < totalPages && handlePageChange(currentPage + 1)}
                    className={currentPage === totalPages ? "pointer-events-none opacity-50" : "cursor-pointer"}
                  />
                </PaginationItem>
              </PaginationContent>
            </Pagination>
          </div>
        </section>
        
        <Footer />
      </div>
    </div>
  );
};

export default FuneralHomes;
