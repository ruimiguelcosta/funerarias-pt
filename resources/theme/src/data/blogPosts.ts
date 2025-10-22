export interface BlogPost {
  id: number;
  title: string;
  excerpt: string;
  author: string;
  date: string;
  image: string;
  category: string;
  content: string[];
}

export const blogPosts: BlogPost[] = [
  {
    id: 1,
    title: "Como Planear um Funeral com Dignidade",
    excerpt: "Orientações essenciais para organizar um funeral que honre a memória do seu ente querido com respeito e serenidade.",
    author: "Maria Silva",
    date: "15 de Março, 2024",
    image: "https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=800&h=500&fit=crop",
    category: "Orientação",
    content: [
      "Planear um funeral pode ser uma tarefa desafiadora, especialmente durante um período de luto. É importante ter em mente que cada detalhe conta para criar uma cerimónia que verdadeiramente honre a memória do seu ente querido.",
      "Comece por escolher uma funerária de confiança que possa guiá-lo através de todas as etapas necessárias. Uma boa funerária oferece não apenas serviços profissionais, mas também apoio emocional durante este momento difícil.",
      "Considere as preferências do falecido e da família ao escolher entre diferentes tipos de cerimónias. Seja uma cerimónia religiosa tradicional ou uma celebração mais personalizada da vida, o importante é que reflita os valores e a personalidade da pessoa que partiu.",
      "Não hesite em pedir ajuda a amigos e familiares. O apoio da comunidade pode ser fundamental neste momento, tanto para questões práticas quanto para o conforto emocional."
    ]
  },
  {
    id: 2,
    title: "Tradições Funerárias em Portugal",
    excerpt: "Conheça as tradições e costumes que fazem parte das cerimónias fúnebres portuguesas e o seu significado profundo.",
    author: "João Santos",
    date: "10 de Março, 2024",
    image: "https://images.unsplash.com/photo-1584907797015-7554cd315667?w=800&h=500&fit=crop",
    category: "Cultura",
    content: [
      "As tradições funerárias em Portugal têm raízes profundas na cultura católica e nas tradições locais que variam de região para região. Estas práticas ajudam as famílias a processar o luto e a honrar os seus entes queridos.",
      "O velório, tradicionalmente realizado em casa ou na funerária, é um momento importante de despedida. Durante este período, amigos e familiares reúnem-se para prestar as suas últimas homenagens e oferecer apoio à família enlutada.",
      "A missa de corpo presente é uma cerimónia religiosa significativa para muitas famílias portuguesas. É um momento de oração e reflexão, onde se celebra a vida do falecido e se pede pela paz da sua alma.",
      "Após o funeral, é comum realizar o 'copo de água', uma reunião informal onde familiares e amigos partilham memórias e fortalecem os laços de apoio mútuo."
    ]
  },
  {
    id: 3,
    title: "Apoio no Processo de Luto",
    excerpt: "Recursos e orientações para enfrentar a perda de um ente querido com apoio profissional e comunitário.",
    author: "Ana Costa",
    date: "5 de Março, 2024",
    image: "https://images.unsplash.com/photo-1519167758481-83f29da8c4f1?w=800&h=500&fit=crop",
    category: "Apoio",
    content: [
      "O luto é um processo natural e pessoal que cada pessoa vivencia de forma única. Não existe uma maneira 'certa' de sentir ou expressar a dor da perda, e é importante permitir-se tempo e espaço para processar estes sentimentos.",
      "Procurar apoio profissional pode ser muito benéfico durante este período. Psicólogos especializados em luto podem oferecer ferramentas e estratégias para lidar com a perda de forma saudável.",
      "Grupos de apoio ao luto proporcionam um espaço seguro onde pode partilhar as suas experiências com outras pessoas que passam por situações semelhantes. Esta partilha pode ser reconfortante e ajuda a perceber que não está sozinho.",
      "Lembre-se de cuidar de si mesmo: mantenha uma rotina saudável, alimente-se bem, descanse e permita-se sentir todas as emoções que surgirem. O autocuidado é fundamental durante o processo de luto."
    ]
  }
];
