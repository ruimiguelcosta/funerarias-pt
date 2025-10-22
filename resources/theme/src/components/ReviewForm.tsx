import { useState } from "react";
import { useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import * as z from "zod";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Textarea } from "@/components/ui/textarea";
import { Star } from "lucide-react";
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from "@/components/ui/form";
import { useToast } from "@/hooks/use-toast";

const reviewSchema = z.object({
  author: z.string().trim().min(1, "O nome é obrigatório").max(100),
  comment: z.string().trim().min(10, "O comentário deve ter pelo menos 10 caracteres").max(500),
  rating: z.number().min(1, "Selecione uma classificação").max(5),
});

type ReviewFormData = z.infer<typeof reviewSchema>;

export const ReviewForm = () => {
  const [selectedRating, setSelectedRating] = useState(0);
  const { toast } = useToast();

  const form = useForm<ReviewFormData>({
    resolver: zodResolver(reviewSchema),
    defaultValues: {
      author: "",
      comment: "",
      rating: 0,
    },
  });

  const onSubmit = (data: ReviewFormData) => {
    toast({
      title: "Avaliação enviada!",
      description: "Obrigado pelo seu feedback.",
    });
    form.reset();
    setSelectedRating(0);
  };

  return (
    <Card className="gradient-card border-border/50 mb-8">
      <CardHeader>
        <CardTitle className="font-playfair text-2xl text-primary">
          Deixe a Sua Avaliação
        </CardTitle>
      </CardHeader>
      <CardContent>
        <Form {...form}>
          <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-6">
            <FormField
              control={form.control}
              name="author"
              render={({ field }) => (
                <FormItem>
                  <FormLabel>Nome</FormLabel>
                  <FormControl>
                    <Input placeholder="O seu nome" {...field} />
                  </FormControl>
                  <FormMessage />
                </FormItem>
              )}
            />

            <FormField
              control={form.control}
              name="rating"
              render={({ field }) => (
                <FormItem>
                  <FormLabel>Classificação</FormLabel>
                  <FormControl>
                    <div className="flex gap-2">
                      {[1, 2, 3, 4, 5].map((rating) => (
                        <button
                          key={rating}
                          type="button"
                          onClick={() => {
                            setSelectedRating(rating);
                            field.onChange(rating);
                          }}
                          className="transition-transform hover:scale-110"
                        >
                          <Star
                            className={`h-8 w-8 ${
                              rating <= selectedRating
                                ? "fill-secondary text-secondary"
                                : "text-muted-foreground"
                            }`}
                          />
                        </button>
                      ))}
                    </div>
                  </FormControl>
                  <FormMessage />
                </FormItem>
              )}
            />

            <FormField
              control={form.control}
              name="comment"
              render={({ field }) => (
                <FormItem>
                  <FormLabel>Comentário</FormLabel>
                  <FormControl>
                    <Textarea
                      placeholder="Partilhe a sua experiência..."
                      className="min-h-[100px]"
                      {...field}
                    />
                  </FormControl>
                  <FormMessage />
                </FormItem>
              )}
            />

            <Button type="submit" className="gradient-primary text-primary-foreground">
              Enviar Avaliação
            </Button>
          </form>
        </Form>
      </CardContent>
    </Card>
  );
};
