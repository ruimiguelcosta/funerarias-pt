<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatGPTService
{
    private string $apiKey;

    private string $baseUrl = 'https://api.openai.com/v1/chat/completions';

    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key') ?? '';
    }

    public function generatePostContent(string $ideaTitle): array
    {
        $prompt = $this->buildPrompt($ideaTitle);

        try {
            $response = Http::timeout(120)->withHeaders([
                'Authorization' => 'Bearer '.$this->apiKey,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl, [
                'model' => 'gpt-4',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Atua como estratega sénior de conteúdos e redator para um site de agências funerárias em Portugal, com elevada especialização em serviços funerários, luto e apoio emocional. Todos os conteúdos devem ser escritos exclusivamente em português europeu (Portugal, AO90). IMPORTANTE: Gera sempre o conteúdo em HTML válido, nunca em Markdown. Usa tags HTML como <h1>, <h2>, <h3>, <p>, <strong>, <em>, <ul>, <li>, <blockquote>, etc.',
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
                'max_tokens' => 4000,
                'temperature' => 0.7,
            ]);

            if ($response->successful()) {
                $content = $response->json('choices.0.message.content');

                return $this->parseResponse($content);
            }

            Log::error('ChatGPT API Error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return $this->getFallbackContent($ideaTitle);

        } catch (\Exception $e) {
            Log::error('ChatGPT Service Error', [
                'message' => $e->getMessage(),
                'idea_title' => $ideaTitle,
            ]);

            return $this->getFallbackContent($ideaTitle);
        }
    }

    private function buildPrompt(string $ideaTitle): string
    {
        return "
# Prompt para escrever conteúdo de qualidade

## Função

Atua como estratega sénior de conteúdos e redator para um site de agências funerárias em Portugal, com elevada especialização em serviços funerários, luto e apoio emocional.

Todos os conteúdos devem ser escritos exclusivamente em português europeu (Portugal, AO90). Qualquer uso de português do Brasil (PT-BR) — mesmo parcial ou inadvertido — é proibido e constitui um erro crítico.

Todos os textos devem estar totalmente otimizados para SEO, GEO, descoberta em motores de IA (ChatGPT, Gemini, Perplexity, etc.), e ter escrita autêntica e humanizada, dirigida a famílias e pessoas que procuram informação sobre serviços funerários em Portugal.

## Contexto

Este blog destina-se a famílias e pessoas que procuram informação prática e aplicável sobre serviços funerários, com soluções para os seus problemas e pontos de dor. O tema principal a desenvolver é: {$ideaTitle}

O objetivo específico é gerar leads qualificados, educar famílias sobre os processos funerários, e demonstrar a importância de escolher agências funerárias de confiança.

## Objetivo

Criar artigos de blog que sejam:

- Claros, humanizados e envolventes, com o objetivo de atrair tráfego qualificado e convertê-lo em leads.
- Totalmente otimizados para motores de pesquisa e descoberta por IA (SEO + GEO).
- Alinhados com as normas Google E-E-A-T 2025.
- Compatíveis com os formatos exigidos por Chatbots e motores de IA.
- **O artigo deve ter entre 500 a 800 palavras**, garantindo profundidade sem ser demasiado extenso.

## Diretrizes

### 1. Escrita e Humanização

- Escrever exclusivamente em português europeu (Portugal), seguindo o AO90.
- Nunca usar termos, ortografia ou construções típicas do português do Brasil.
- Evitar o gerúndio típico do Brasil e usar formas simples do português europeu.
- Usar apenas pontuação e caracteres normais de teclado.
- Linguagem natural e idiomática de Portugal: evitar clichés, traduções literais e termos artificiais.
- Variar o comprimento das frases, preferir voz ativa, alternar entre registo formal e mais próximo consoante o contexto.
- Integrar referências locais, exemplos reais e um tom subtilmente humano.
- Títulos de secções devem ser específicos, conter palavras-chave ou responder a perguntas.
- Usar apenas parágrafos corridos (exceto FAQ ou TL;DR, onde se permitem listas simples).

### 2. SEO, GEO e IA

- Estrutura clara de títulos: H1 > H2 > H3. Sempre que possível, usar perguntas reais de utilizadores.
- A palavra-chave principal deve aparecer no título, no primeiro parágrafo e em cabeçalhos-chave.
- Palavras-chave secundárias e variantes semânticas devem ser integradas naturalmente.
- Incluir dados estruturados schema.org, em especial em FAQ.
- As FAQs devem ser curtas, diretas e no estilo \"snippet\".
- Usar sempre dados atuais (ano em curso), estudos relevantes e exemplos concretos.
- Demonstrar experiência, autoridade e confiança (E-E-A-T).

### 3. CTAs e Ligações Internas

- Terminar sempre com um CTA claro, conciso e orientado para a ação.
- Exemplos de CTA:
  - Contactar uma agência funerária de confiança.
  - Solicitar informações sobre serviços funerários.
  - Subscrever a newsletter para mais informações.
  - Descarregar guias práticos sobre processos funerários.

## Estrutura Base do Artigo

- **Título SEO (H1 com palavra-chave principal)**
- **Citação + Autor**
- **Introdução** (pergunta direta ou afirmação que desperte curiosidade)
- **Índice de Conteúdos**
- **O que é [Tema]**
- **Como funciona / Exemplos**
- **Principais tipos ou categorias**
- **Aplicações e casos de uso**
- **Benefícios vs Limitações**
- **Tendências futuras**
- **FAQ**
- **Resumo / TL;DR**
- **Call to Action**

## Resposta Esperada

Por favor, gere o conteúdo completo do artigo seguindo exatamente esta estrutura. IMPORTANTE: Todo o conteúdo deve estar em HTML válido, nunca em Markdown. Usa tags HTML como <h1>, <h2>, <h3>, <p>, <strong>, <em>, <ul>, <li>, <blockquote>, etc.

No final, inclua também:

- **Meta Title** (máximo 60 caracteres)
- **Meta Description** (máximo 160 caracteres)
- **Slug** (URL amigável)

Responde apenas com o conteúdo do artigo em HTML, seguido pelos metadados no final.
        ";
    }

    private function parseResponse(string $content): array
    {
        $lines = explode("\n", $content);
        $article = [];
        $metaTitle = '';
        $metaDescription = '';
        $slug = '';

        $currentSection = '';
        $inMetaSection = false;

        foreach ($lines as $line) {
            $line = trim($line);

            if (str_starts_with($line, '**Meta Title**')) {
                $inMetaSection = true;
                $metaTitle = trim(str_replace('**Meta Title**', '', $line));

                continue;
            }

            if (str_starts_with($line, '**Meta Description**')) {
                $metaDescription = trim(str_replace('**Meta Description**', '', $line));

                continue;
            }

            if (str_starts_with($line, '**Slug**')) {
                $slug = trim(str_replace('**Slug**', '', $line));

                continue;
            }

            if ($inMetaSection) {
                continue;
            }

            // Aceita tanto HTML quanto Markdown para compatibilidade
            if (str_starts_with($line, '#') || str_starts_with($line, '<')) {
                $currentSection = $line;
                $article[] = $line;
            } elseif (! empty($line)) {
                $article[] = $line;
            }
        }

        return [
            'title' => $this->extractTitle($article),
            'content' => implode("\n", $article),
            'meta_title' => $metaTitle ?: $this->extractTitle($article),
            'meta_description' => $metaDescription ?: $this->generateMetaDescription($article),
            'slug' => $slug ?: $this->generateSlug($this->extractTitle($article)),
        ];
    }

    private function extractTitle(array $article): string
    {
        foreach ($article as $line) {
            // Suporte para HTML <h1>
            if (str_starts_with($line, '<h1>')) {
                return trim(strip_tags($line));
            }

            // Suporte para Markdown # (compatibilidade)
            if (str_starts_with($line, '# ') && ! str_contains($line, '##')) {
                return trim(str_replace('# ', '', $line));
            }
        }

        return 'Artigo Gerado';
    }

    private function generateMetaDescription(array $article): string
    {
        $content = implode(' ', $article);
        // Remove tags HTML para gerar meta description limpa
        $content = strip_tags($content);
        $description = substr($content, 0, 160);

        return trim($description).'...';
    }

    private function generateSlug(string $title): string
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
    }

    private function getFallbackContent(string $ideaTitle): array
    {
        return [
            'title' => $ideaTitle,
            'content' => "<h1>{$ideaTitle}</h1>\n\n<p>Este artigo será desenvolvido em breve com informações detalhadas sobre este tema importante relacionado com serviços funerários em Portugal.</p>",
            'meta_title' => $ideaTitle,
            'meta_description' => "Informações detalhadas sobre {$ideaTitle}. Guia completo para famílias em Portugal.",
            'slug' => $this->generateSlug($ideaTitle),
        ];
    }
}
