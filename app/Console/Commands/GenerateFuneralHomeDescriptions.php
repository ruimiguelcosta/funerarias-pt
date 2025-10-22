<?php

namespace App\Console\Commands;

use App\Models\FuneralHome;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GenerateFuneralHomeDescriptions extends Command
{
    protected $signature = 'funeral-homes:generate-descriptions {--limit=5 : Number of funeral homes to process}';

    protected $description = 'Generate AI-powered descriptions for funeral homes using OpenAI API';

    public function handle(): int
    {
        $limit = $this->option('limit');
        
        $this->info("Generating descriptions for {$limit} funeral homes...");

        // Get funeral homes without generated descriptions or with old ones
        $funeralHomes = FuneralHome::query()
            ->where(function ($query) {
                $query->whereNull('generated_description')
                      ->orWhere('description_generated_at', '<', now()->subDays(30));
            })
            ->whereNotNull('title')
            ->whereNotNull('city')
            ->limit($limit)
            ->get();

        if ($funeralHomes->isEmpty()) {
            $this->info('No funeral homes need description generation.');
            return Command::SUCCESS;
        }

        $bar = $this->output->createProgressBar($funeralHomes->count());
        $bar->start();

        $successCount = 0;
        $errorCount = 0;

        foreach ($funeralHomes as $funeralHome) {
            try {
                $description = $this->generateDescription($funeralHome);
                
                if ($description) {
                    $funeralHome->update([
                        'generated_description' => $description,
                        'description_generated_at' => now(),
                    ]);
                    $successCount++;
                } else {
                    $errorCount++;
                }
            } catch (\Exception $e) {
                Log::error("Failed to generate description for funeral home {$funeralHome->id}: " . $e->getMessage());
                $errorCount++;
            }

            $bar->advance();
            
            // Add delay to avoid rate limiting
            sleep(2);
        }

        $bar->finish();
        $this->newLine();
        
        $this->info("Description generation completed!");
        $this->info("✅ Successfully generated: {$successCount}");
        $this->info("❌ Failed: {$errorCount}");

        return Command::SUCCESS;
    }

    private function generateDescription(FuneralHome $funeralHome): ?string
    {
        $openaiApiKey = config('services.openai.api_key');
        
        if (!$openaiApiKey) {
            $this->error('OpenAI API key not configured. Please set OPENAI_API_KEY in your .env file.');
            return null;
        }

        // Prepare context about the funeral home
        $context = $this->buildContext($funeralHome);

        $prompt = "Como especialista em serviços funerários em Portugal, crie uma descrição profissional e empática para a seguinte funerária:

INFORMAÇÕES DA FUNERÁRIA:
{$context}

INSTRUÇÕES:
- Crie uma descrição única e personalizada (máximo 300 palavras)
- Use um tom respeitoso, profissional e empático
- Mencione serviços específicos baseados na localização e tipo de negócio
- Inclua valores como compaixão, respeito, profissionalismo
- Escreva em português de Portugal
- Evite informações genéricas, seja específico sobre esta funerária
- Não mencione preços específicos
- Foque nos benefícios para as famílias

FORMATO: Texto corrido, sem bullet points, com parágrafos bem estruturados.";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $openaiApiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ]
                ],
                'max_tokens' => 500,
                'temperature' => 0.7,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['choices'][0]['message']['content'] ?? null;
            } else {
                Log::error('OpenAI API error: ' . $response->body());
                return null;
            }
        } catch (\Exception $e) {
            Log::error('OpenAI API exception: ' . $e->getMessage());
            return null;
        }
    }

    private function buildContext(FuneralHome $funeralHome): string
    {
        $context = "Nome: {$funeralHome->title}\n";
        $context .= "Cidade: {$funeralHome->city}\n";
        
        if ($funeralHome->address) {
            $context .= "Endereço: {$funeralHome->address}\n";
        }
        
        if ($funeralHome->phone) {
            $context .= "Telefone: {$funeralHome->phone}\n";
        }
        
        if ($funeralHome->website) {
            $context .= "Website: {$funeralHome->website}\n";
        }
        
        if ($funeralHome->category_name) {
            $context .= "Categoria: {$funeralHome->category_name}\n";
        }
        
        if ($funeralHome->description) {
            $context .= "Descrição existente: {$funeralHome->description}\n";
        }
        
        if ($funeralHome->total_score) {
            $context .= "Avaliação média: {$funeralHome->total_score}/5\n";
        }
        
        if ($funeralHome->reviews_count) {
            $context .= "Número de avaliações: {$funeralHome->reviews_count}\n";
        }

        return $context;
    }
}
