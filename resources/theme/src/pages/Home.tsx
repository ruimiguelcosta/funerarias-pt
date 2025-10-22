import Navbar from "@/components/Navbar";
import Hero from "@/components/Hero";
import FuneralHomeCard from "@/components/FuneralHomeCard";
import BlogPostCard from "@/components/BlogPostCard";
import { Footer } from "@/components/Footer";
import { blogPosts } from "@/data/blogPosts";

const funeralHomes = [
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
  }
];

const Home = () => {
  return (
    <div className="min-h-screen">
      <Navbar />
      <div className="pt-20">
        <Hero />
        
        <section className="py-20 bg-background">
          <div className="container mx-auto px-4">
            <div className="text-center mb-12">
              <h2 className="font-playfair text-4xl md:text-5xl font-bold text-primary mb-4">
                Funerárias de Confiança
              </h2>
              <p className="text-lg text-muted-foreground max-w-2xl mx-auto">
                Selecionamos as melhores funerárias com serviços de excelência 
                para apoiar sua família neste momento.
              </p>
            </div>
            
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              {funeralHomes.map((home) => (
                <FuneralHomeCard key={home.id} {...home} />
              ))}
            </div>
          </div>
        </section>
        
        <section className="py-20 gradient-card">
          <div className="container mx-auto px-4">
            <div className="max-w-4xl mx-auto">
              <h2 className="font-playfair text-4xl md:text-5xl font-bold text-primary text-center mb-12">
                Por Que Escolher-nos
              </h2>
              
              <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div className="text-center">
                  <div className="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span className="text-3xl">🕊️</span>
                  </div>
                  <h3 className="font-playfair text-xl font-semibold text-primary mb-2">
                    Dignidade
                  </h3>
                  <p className="text-muted-foreground">
                    Tratamos cada família com o máximo respeito e dignidade.
                  </p>
                </div>
                
                <div className="text-center">
                  <div className="w-16 h-16 bg-secondary/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span className="text-3xl">💛</span>
                  </div>
                  <h3 className="font-playfair text-xl font-semibold text-primary mb-2">
                    Compaixão
                  </h3>
                  <p className="text-muted-foreground">
                    Apoio emocional e compreensão em momentos difíceis.
                  </p>
                </div>
                
                <div className="text-center">
                  <div className="w-16 h-16 bg-accent/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span className="text-3xl">⭐</span>
                  </div>
                  <h3 className="font-playfair text-xl font-semibold text-primary mb-2">
                    Excelência
                  </h3>
                  <p className="text-muted-foreground">
                    Serviços de qualidade superior com atenção aos detalhes.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </section>
        
        <section className="py-20 bg-background">
          <div className="container mx-auto px-4">
            <div className="text-center mb-12">
              <h2 className="font-playfair text-4xl md:text-5xl font-bold text-primary mb-4">
                Últimos Artigos
              </h2>
              <p className="text-lg text-muted-foreground max-w-2xl mx-auto">
                Informações e orientações para apoiar sua família em momentos difíceis.
              </p>
            </div>
            
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              {blogPosts.map((post) => (
                <BlogPostCard key={post.id} {...post} />
              ))}
            </div>
          </div>
        </section>
        
        <Footer />
      </div>
    </div>
  );
};

export default Home;
