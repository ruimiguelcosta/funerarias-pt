import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import { Link } from "react-router-dom";
import { Calendar, User } from "lucide-react";

interface BlogPostCardProps {
  id: number;
  title: string;
  excerpt: string;
  author: string;
  date: string;
  image: string;
  category: string;
}

const BlogPostCard = ({ id, title, excerpt, author, date, image, category }: BlogPostCardProps) => {
  return (
    <Card className="overflow-hidden hover:shadow-elegant transition-smooth">
      <div className="aspect-video overflow-hidden">
        <img 
          src={image} 
          alt={title}
          className="w-full h-full object-cover hover:scale-105 transition-smooth"
        />
      </div>
      <CardHeader>
        <div className="flex items-center gap-2 mb-2">
          <span className="text-xs font-semibold text-secondary px-3 py-1 rounded-full bg-secondary/10">
            {category}
          </span>
        </div>
        <CardTitle className="font-playfair text-xl">{title}</CardTitle>
        <CardDescription className="flex items-center gap-4 text-sm mt-2">
          <span className="flex items-center gap-1">
            <User className="w-4 h-4" />
            {author}
          </span>
          <span className="flex items-center gap-1">
            <Calendar className="w-4 h-4" />
            {date}
          </span>
        </CardDescription>
      </CardHeader>
      <CardContent>
        <p className="text-muted-foreground mb-4">{excerpt}</p>
        <Link to={`/post/${id}`}>
          <Button variant="outline" className="w-full">
            Ler Mais
          </Button>
        </Link>
      </CardContent>
    </Card>
  );
};

export default BlogPostCard;
