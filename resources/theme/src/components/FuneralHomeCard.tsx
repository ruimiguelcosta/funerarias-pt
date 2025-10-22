import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import { MapPin, Phone, Star } from "lucide-react";
import { Link } from "react-router-dom";

interface FuneralHomeCardProps {
  id: number;
  name: string;
  location: string;
  phone: string;
  rating: number;
  description: string;
  image: string;
}

const FuneralHomeCard = ({ id, name, location, phone, rating, description, image }: FuneralHomeCardProps) => {
  return (
    <Card className="overflow-hidden transition-smooth hover:shadow-elegant hover:-translate-y-1 gradient-card border-border/50">
      <div className="h-48 overflow-hidden">
        <img 
          src={image} 
          alt={name} 
          className="w-full h-full object-cover transition-smooth hover:scale-105"
        />
      </div>
      <CardHeader>
        <div className="flex justify-between items-start">
          <CardTitle className="font-playfair text-2xl text-primary">{name}</CardTitle>
          <div className="flex items-center gap-1 bg-secondary/20 px-2 py-1 rounded-full">
            <Star className="h-4 w-4 fill-secondary text-secondary" />
            <span className="text-sm font-semibold text-secondary-foreground">{rating}</span>
          </div>
        </div>
        <CardDescription className="text-muted-foreground">{description}</CardDescription>
      </CardHeader>
      <CardContent>
        <div className="space-y-2 mb-4">
          <div className="flex items-center gap-2 text-sm text-foreground">
            <MapPin className="h-4 w-4 text-accent" />
            <span>{location}</span>
          </div>
          <div className="flex items-center gap-2 text-sm text-foreground">
            <Phone className="h-4 w-4 text-accent" />
            <span>{phone}</span>
          </div>
        </div>
        <Link to={`/funeraria/${id}`}>
          <Button className="w-full gradient-primary text-primary-foreground">
            Ver Detalhes
          </Button>
        </Link>
      </CardContent>
    </Card>
  );
};

export default FuneralHomeCard;
