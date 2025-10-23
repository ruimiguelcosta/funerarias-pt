<?php

namespace Database\Seeders;

use App\Models\PostIdea;
use Illuminate\Database\Seeder;

class PostIdeaSeeder extends Seeder
{
    public function run(): void
    {
        $ideas = [
            // Guias e Informação Prática
            [
                'title' => 'O que fazer quando alguém morre: guia passo a passo',
                'category' => 'Guias e Informação Prática',
            ],
            [
                'title' => 'Documentos necessários após o falecimento de um familiar',
                'category' => 'Guias e Informação Prática',
            ],
            [
                'title' => 'Como escolher uma agência funerária de confiança',
                'category' => 'Guias e Informação Prática',
            ],
            [
                'title' => 'Diferença entre funeral, velório e cremação',
                'category' => 'Guias e Informação Prática',
            ],
            [
                'title' => 'O que está incluído num serviço funerário completo',
                'category' => 'Guias e Informação Prática',
            ],
            [
                'title' => 'Quanto custa um funeral em Portugal: valores médios e opções',
                'category' => 'Guias e Informação Prática',
            ],
            [
                'title' => 'Como funciona a cremação em Portugal',
                'category' => 'Guias e Informação Prática',
            ],
            [
                'title' => 'Como proceder ao transporte de um corpo entre países',
                'category' => 'Guias e Informação Prática',
            ],
            [
                'title' => 'Diferença entre sepultamento em jazigo e sepultura comum',
                'category' => 'Guias e Informação Prática',
            ],
            [
                'title' => 'Como escolher o caixão ou urna mais adequada',
                'category' => 'Guias e Informação Prática',
            ],

            // Serviços e Processos
            [
                'title' => 'O que é um plano funerário e como funciona',
                'category' => 'Serviços e Processos',
            ],
            [
                'title' => 'Vantagens de contratar um plano funerário antecipado',
                'category' => 'Serviços e Processos',
            ],
            [
                'title' => 'Como funciona o funeral a crédito: prazos e condições',
                'category' => 'Serviços e Processos',
            ],
            [
                'title' => 'Como organizar uma cerimónia fúnebre religiosa',
                'category' => 'Serviços e Processos',
            ],
            [
                'title' => 'Serviços funerários laicos: o que são e como funcionam',
                'category' => 'Serviços e Processos',
            ],
            [
                'title' => 'O papel do agente funerário: o que faz e como ajuda',
                'category' => 'Serviços e Processos',
            ],
            [
                'title' => 'Como funciona a tanatopraxia e a preparação do corpo',
                'category' => 'Serviços e Processos',
            ],
            [
                'title' => 'O que é a cremação e quanto custa',
                'category' => 'Serviços e Processos',
            ],
            [
                'title' => 'O que inclui o transporte funerário e como é feito',
                'category' => 'Serviços e Processos',
            ],
            [
                'title' => 'O que é o certificado de óbito e onde obtê-lo',
                'category' => 'Serviços e Processos',
            ],

            // Apoio Emocional e Luto
            [
                'title' => 'Como lidar com o luto após a perda de um ente querido',
                'category' => 'Apoio Emocional e Luto',
            ],
            [
                'title' => 'Fases do luto: o que esperar e como ultrapassar',
                'category' => 'Apoio Emocional e Luto',
            ],
            [
                'title' => 'Como apoiar alguém que perdeu um familiar',
                'category' => 'Apoio Emocional e Luto',
            ],
            [
                'title' => 'Conselhos de psicólogos para enfrentar o luto',
                'category' => 'Apoio Emocional e Luto',
            ],
            [
                'title' => 'Como explicar a morte a uma criança',
                'category' => 'Apoio Emocional e Luto',
            ],
            [
                'title' => 'Atividades simbólicas que ajudam a lidar com o luto',
                'category' => 'Apoio Emocional e Luto',
            ],
            [
                'title' => 'Como organizar uma homenagem póstuma significativa',
                'category' => 'Apoio Emocional e Luto',
            ],
            [
                'title' => 'Frases e mensagens de condolências com significado',
                'category' => 'Apoio Emocional e Luto',
            ],
            [
                'title' => 'Músicas mais escolhidas para funerais e homenagens',
                'category' => 'Apoio Emocional e Luto',
            ],
            [
                'title' => 'Como lidar com o primeiro aniversário após a perda',
                'category' => 'Apoio Emocional e Luto',
            ],

            // Sustentabilidade e Inovação
            [
                'title' => 'Funerais ecológicos: o que são e como funcionam',
                'category' => 'Sustentabilidade e Inovação',
            ],
            [
                'title' => 'Caixões e urnas biodegradáveis: uma opção amiga do ambiente',
                'category' => 'Sustentabilidade e Inovação',
            ],
            [
                'title' => 'Cemitérios verdes e enterros naturais: uma tendência em crescimento',
                'category' => 'Sustentabilidade e Inovação',
            ],
            [
                'title' => 'Crematórios sustentáveis: redução de impacto ambiental',
                'category' => 'Sustentabilidade e Inovação',
            ],
            [
                'title' => 'A inovação digital nos serviços funerários',
                'category' => 'Sustentabilidade e Inovação',
            ],
            [
                'title' => 'Como criar um memorial digital em homenagem a um ente querido',
                'category' => 'Sustentabilidade e Inovação',
            ],
            [
                'title' => 'Transmissão online de funerais: como funciona',
                'category' => 'Sustentabilidade e Inovação',
            ],
            [
                'title' => 'Aplicações móveis e plataformas para planeamento funerário',
                'category' => 'Sustentabilidade e Inovação',
            ],
            [
                'title' => 'Inteligência artificial e o futuro do setor funerário',
                'category' => 'Sustentabilidade e Inovação',
            ],
            [
                'title' => 'O papel da tecnologia na gestão de cemitérios',
                'category' => 'Sustentabilidade e Inovação',
            ],

            // Tradições, Cultura e História
            [
                'title' => 'Rituais fúnebres em diferentes religiões',
                'category' => 'Tradições, Cultura e História',
            ],
            [
                'title' => 'Tradições funerárias portuguesas ao longo do tempo',
                'category' => 'Tradições, Cultura e História',
            ],
            [
                'title' => 'Significado das flores usadas em funerais',
                'category' => 'Tradições, Cultura e História',
            ],
            [
                'title' => 'O simbolismo das cores nas cerimónias fúnebres',
                'category' => 'Tradições, Cultura e História',
            ],
            [
                'title' => 'O significado dos epitáfios e inscrições tumulares',
                'category' => 'Tradições, Cultura e História',
            ],
            [
                'title' => 'Monumentos e arte tumular em Portugal',
                'category' => 'Tradições, Cultura e História',
            ],
            [
                'title' => 'Cemitérios históricos portugueses que vale a pena visitar',
                'category' => 'Tradições, Cultura e História',
            ],
            [
                'title' => 'Como a cultura influencia as cerimónias de despedida',
                'category' => 'Tradições, Cultura e História',
            ],
            [
                'title' => 'Superstições e crenças populares associadas à morte',
                'category' => 'Tradições, Cultura e História',
            ],
            [
                'title' => 'Como o cinema e a literatura representam o luto',
                'category' => 'Tradições, Cultura e História',
            ],

            // Conteúdo Local e Comparativo
            [
                'title' => 'Melhores agências funerárias em Lisboa',
                'category' => 'Conteúdo Local e Comparativo',
            ],
            [
                'title' => 'Melhores agências funerárias no Porto',
                'category' => 'Conteúdo Local e Comparativo',
            ],
            [
                'title' => 'Agências funerárias recomendadas no Algarve',
                'category' => 'Conteúdo Local e Comparativo',
            ],
            [
                'title' => 'Comparativo de preços entre agências funerárias',
                'category' => 'Conteúdo Local e Comparativo',
            ],
            [
                'title' => 'Como encontrar uma agência funerária perto de si',
                'category' => 'Conteúdo Local e Comparativo',
            ],
            [
                'title' => 'O papel das agências funerárias municipais',
                'category' => 'Conteúdo Local e Comparativo',
            ],
            [
                'title' => 'Como verificar se uma agência funerária é licenciada',
                'category' => 'Conteúdo Local e Comparativo',
            ],
            [
                'title' => 'Entrevistas com diretores funerários: bastidores do setor',
                'category' => 'Conteúdo Local e Comparativo',
            ],
            [
                'title' => 'Guia de cemitérios e crematórios por distrito',
                'category' => 'Conteúdo Local e Comparativo',
            ],
            [
                'title' => 'Como funciona a assistência funerária internacional',
                'category' => 'Conteúdo Local e Comparativo',
            ],
        ];

        foreach ($ideas as $idea) {
            PostIdea::query()->create([
                'title' => $idea['title'],
                'category' => $idea['category'],
                'is_used' => false,
            ]);
        }
    }
}
