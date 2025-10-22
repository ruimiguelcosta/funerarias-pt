import { useParams, Link } from "react-router-dom";
import Navbar from "@/components/Navbar";
import { Footer } from "@/components/Footer";
import { Button } from "@/components/ui/button";
import { Calendar, User, ArrowLeft } from "lucide-react";
import { blogPosts } from "@/data/blogPosts";

const BlogPostDetail = () => {
  const { id } = useParams();
  const post = blogPosts.find(p => p.id === Number(id));

  if (!post) {
    return (
      <div className="min-h-screen">
        <Navbar />
        <div className="container mx-auto px-4 py-20">
          <p className="text-center">Post não encontrado</p>
        </div>
        <Footer />
      </div>
    );
  }

  return (
    <div className="min-h-screen">
      <Navbar />
      <div className="pt-20">
        <article className="container mx-auto px-4 py-12 max-w-4xl">
          <Link to="/">
            <Button variant="ghost" className="mb-6">
              <ArrowLeft className="w-4 h-4 mr-2" />
              Voltar
            </Button>
          </Link>

          <div className="mb-6">
            <span className="text-sm font-semibold text-secondary px-3 py-1 rounded-full bg-secondary/10">
              {post.category}
            </span>
          </div>

          <h1 className="font-playfair text-4xl md:text-5xl font-bold text-primary mb-6">
            {post.title}
          </h1>

          <div className="flex items-center gap-6 text-muted-foreground mb-8">
            <span className="flex items-center gap-2">
              <User className="w-5 h-5" />
              {post.author}
            </span>
            <span className="flex items-center gap-2">
              <Calendar className="w-5 h-5" />
              {post.date}
            </span>
          </div>

          <div className="aspect-video overflow-hidden rounded-lg mb-8">
            <img 
              src={post.image} 
              alt={post.title}
              className="w-full h-full object-cover"
            />
          </div>

          <div className="prose prose-lg max-w-none">
            {post.content.map((paragraph, index) => (
              <p key={index} className="text-foreground mb-4 leading-relaxed">
                {paragraph}
              </p>
            ))}
          </div>

          <div className="mt-12 pt-8 border-t">
            <h3 className="font-playfair text-2xl font-bold text-primary mb-6">
              Posts Relacionados
            </h3>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              {blogPosts
                .filter(p => p.id !== post.id && p.category === post.category)
                .slice(0, 2)
                .map(relatedPost => (
                  <Link 
                    key={relatedPost.id} 
                    to={`/post/${relatedPost.id}`}
                    className="group"
                  >
                    <div className="aspect-video overflow-hidden rounded-lg mb-3">
                      <img 
                        src={relatedPost.image} 
                        alt={relatedPost.title}
                        className="w-full h-full object-cover group-hover:scale-105 transition-smooth"
                      />
                    </div>
                    <h4 className="font-playfair text-lg font-semibold text-primary group-hover:text-secondary transition-smooth">
                      {relatedPost.title}
                    </h4>
                  </Link>
                ))}
            </div>
          </div>
        </article>
        <Footer />
      </div>
    </div>
  );
};

export default BlogPostDetail;
