import { useParams } from "react-router-dom";
import Navbar from "@/components/Navbar";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { MapPin, Phone, Clock, Mail, Star } from "lucide-react";
import { Footer } from "@/components/Footer";
import { ReviewForm } from "@/components/ReviewForm";

const funeralHomeData: { [key: string]: any } = {
  "1": {
    name: "Funerária Paz Eterna",
    location: "Rua das Flores, 123, Lisboa",
    phone: "+351 21 123 4567",
    email: "contacto@pazeterna.pt",
    hours: "Aberto 24 horas",
    rating: 4.9,
    description: "A Funerária Paz Eterna serve a comunidade há mais de 50 anos com tradição, respeito e dignidade. Nossa equipe dedicada está disponível 24 horas para apoiar sua família nos momentos mais difíceis.",
    image: "https://images.unsplash.com/photo-1584907797015-7554cd315667?w=800&h=400&fit=crop",
    services: [
      { name: "Velório Tradicional", description: "Espaço digno e acolhedor para despedidas", price: "Desde €800" },
      { name: "Cremação", description: "Serviço completo de cremação com cerimónia", price: "Desde €1.200" },
      { name: "Transporte Funerário", description: "Transporte nacional e internacional", price: "Desde €300" },
      { name: "Flores e Coroas", description: "Arranjos florais personalizados", price: "Desde €50" },
      { name: "Documentação", description: "Tratamento de toda a documentação necessária", price: "Incluído" },
      { name: "Apoio Psicológico", description: "Suporte emocional para a família", price: "Gratuito" }
    ],
    reviews: [
      { author: "Maria Silva", rating: 5, comment: "Profissionalismo e empatia excepcionais. A equipe nos apoiou em todos os momentos difíceis.", date: "2 semanas atrás" },
      { author: "João Santos", rating: 5, comment: "Serviço impecável com atenção aos detalhes. Muito obrigado por todo o cuidado.", date: "1 mês atrás" },
      { author: "Ana Costa", rating: 5, comment: "Recomendo fortemente. Trataram tudo com respeito e dignidade.", date: "2 meses atrás" }
    ]
  },
  "2": {
    name: "Serviços Funerários Luz",
    location: "Avenida da Boavista, 456, Porto",
    phone: "+351 22 987 6543",
    email: "info@luz.pt",
    hours: "Aberto 24 horas",
    rating: 4.8,
    description: "Os Serviços Funerários Luz oferecem dedicação e profissionalismo, apoiando famílias com compaixão e respeito em todos os momentos.",
    image: "https://images.unsplash.com/photo-1519167758481-83f29da8c4f1?w=800&h=400&fit=crop",
    services: [
      { name: "Velório Premium", description: "Salas privadas com todo o conforto", price: "Desde €1.000" },
      { name: "Sepultamento", description: "Serviço completo de sepultamento", price: "Desde €900" },
      { name: "Cerimónia Religiosa", description: "Coordenação de cerimónias religiosas", price: "Desde €200" },
      { name: "Fotografia e Vídeo", description: "Registo da cerimónia", price: "Desde €150" },
      { name: "Catering", description: "Serviço de catering para convidados", price: "Desde €10/pessoa" },
      { name: "Memorial Online", description: "Página de homenagem digital", price: "Gratuito" }
    ],
    reviews: [
      { author: "Carlos Ferreira", rating: 5, comment: "Equipe maravilhosa que nos guiou com carinho e profissionalismo.", date: "3 semanas atrás" },
      { author: "Sofia Oliveira", rating: 5, comment: "Muito agradecida pelo apoio e pela organização impecável.", date: "1 mês atrás" },
      { author: "Pedro Alves", rating: 4, comment: "Bom serviço, atenciosos e respeitosos.", date: "2 meses atrás" }
    ]
  },
  "3": {
    name: "Funerária Serenidade",
    location: "Praça do Comércio, 789, Coimbra",
    phone: "+351 23 456 7890",
    email: "contacto@serenidade.pt",
    hours: "Aberto 24 horas",
    rating: 4.7,
    description: "A Funerária Serenidade oferece cuidado personalizado e atenção aos detalhes para honrar seus entes queridos com dignidade e respeito.",
    image: "https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=800&h=400&fit=crop",
    services: [
      { name: "Velório Ecológico", description: "Opções sustentáveis e ecológicas", price: "Desde €750" },
      { name: "Cremação Verde", description: "Cremação com baixo impacto ambiental", price: "Desde €1.100" },
      { name: "Urnas Biodegradáveis", description: "Urnas ecológicas personalizadas", price: "Desde €100" },
      { name: "Jardim Memorial", description: "Espaço verde para homenagens", price: "Desde €500" },
      { name: "Celebração da Vida", description: "Cerimónias personalizadas", price: "Desde €300" },
      { name: "Consultoria Familiar", description: "Orientação completa para a família", price: "Gratuito" }
    ],
    reviews: [
      { author: "Teresa Rodrigues", rating: 5, comment: "Abordagem respeitosa e moderna. Adoramos a opção ecológica.", date: "2 semanas atrás" },
      { author: "Miguel Carvalho", rating: 5, comment: "Muito sensíveis às nossas necessidades. Excelente serviço.", date: "3 semanas atrás" },
      { author: "Isabel Martins", rating: 4, comment: "Bom atendimento e instalações bonitas.", date: "1 mês atrás" }
    ]
  }
};

const FuneralHomeDetail = () => {
  const { id } = useParams();
  const home = funeralHomeData[id || "1"];

  if (!home) {
    return <div>Funerária não encontrada</div>;
  }

  return (
    <div className="min-h-screen bg-background">
      <Navbar />
      <div className="pt-20">
        <div 
          className="h-[400px] bg-cover bg-center relative"
          style={{ backgroundImage: `url(${home.image})` }}
        >
          <div className="absolute inset-0 gradient-hero" />
        </div>
        
        <section className="py-16">
          <div className="container mx-auto px-4">
            <div className="max-w-5xl mx-auto">
              <div className="flex justify-between items-start mb-8">
                <div>
                  <h1 className="font-playfair text-4xl md:text-5xl font-bold text-primary mb-4">
                    {home.name}
                  </h1>
                </div>
                <div className="flex items-center gap-2 bg-secondary/20 px-4 py-2 rounded-full">
                  <Star className="h-5 w-5 fill-secondary text-secondary" />
                  <span className="text-xl font-bold text-secondary-foreground">{home.rating}</span>
                </div>
              </div>
              
              <Card className="mb-8 gradient-card border-border/50">
                <CardHeader>
                  <CardTitle className="font-playfair text-2xl text-primary">
                    Informações de Contacto
                  </CardTitle>
                </CardHeader>
                <CardContent className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div className="flex items-start gap-3">
                    <MapPin className="h-5 w-5 text-accent mt-1" />
                    <div>
                      <p className="font-semibold text-foreground">Morada</p>
                      <p className="text-muted-foreground">{home.location}</p>
                    </div>
                  </div>
                  <div className="flex items-start gap-3">
                    <Phone className="h-5 w-5 text-accent mt-1" />
                    <div>
                      <p className="font-semibold text-foreground">Telefone</p>
                      <p className="text-muted-foreground">{home.phone}</p>
                    </div>
                  </div>
                  <div className="flex items-start gap-3">
                    <Mail className="h-5 w-5 text-accent mt-1" />
                    <div>
                      <p className="font-semibold text-foreground">Email</p>
                      <p className="text-muted-foreground">{home.email}</p>
                    </div>
                  </div>
                  <div className="flex items-start gap-3">
                    <Clock className="h-5 w-5 text-accent mt-1" />
                    <div>
                      <p className="font-semibold text-foreground">Horário</p>
                      <p className="text-muted-foreground">{home.hours}</p>
                    </div>
                  </div>
                </CardContent>
              </Card>
              
              <Card className="mb-12 gradient-card border-border/50">
                <CardHeader>
                  <CardTitle className="font-playfair text-3xl text-primary">
                    Sobre Nós
                  </CardTitle>
                </CardHeader>
                <CardContent>
                  <p className="text-foreground text-lg leading-relaxed">
                    {home.description}
                  </p>
                </CardContent>
              </Card>
              
              <div>
                <h2 className="font-playfair text-3xl font-bold text-primary mb-6">
                  Avaliações de Clientes
                </h2>
                
                <ReviewForm />
                
                <div className="space-y-6">
                  {home.reviews.map((review: any, index: number) => (
                    <Card key={index} className="gradient-card border-border/50">
                      <CardHeader>
                        <div className="flex justify-between items-start">
                          <div>
                            <CardTitle className="text-lg text-primary">
                              {review.author}
                            </CardTitle>
                            <p className="text-sm text-muted-foreground">{review.date}</p>
                          </div>
                          <div className="flex gap-1">
                            {[...Array(review.rating)].map((_, i) => (
                              <Star key={i} className="h-4 w-4 fill-secondary text-secondary" />
                            ))}
                          </div>
                        </div>
                      </CardHeader>
                      <CardContent>
                        <p className="text-foreground italic">"{review.comment}"</p>
                      </CardContent>
                    </Card>
                  ))}
                </div>
              </div>
              
              <div className="mt-12 text-center">
                <Button size="lg" className="gradient-primary text-primary-foreground">
                  Contactar Agora
                </Button>
              </div>
            </div>
          </div>
        </section>
        
        <Footer />
      </div>
    </div>
  );
};

export default FuneralHomeDetail;
