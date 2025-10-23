<?php

namespace App\Console\Commands;

use App\Domain\PostIdeas\Services\PostIdeaService;
use App\Models\PostIdea;
use App\Services\ChatGPTService;
use App\Services\PostFuneralHomesBlockService;
use App\Services\UnsplashService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GeneratePostCommand extends Command
{
    protected $signature = 'posts:generate {--idea-id= : ID específico da ideia para usar}';

    protected $description = 'Gera um post automaticamente usando uma ideia não utilizada e ChatGPT';

    public function __construct(
        private PostIdeaService $postIdeaService,
        private ChatGPTService $chatGPTService,
        private UnsplashService $unsplashService,
        private PostFuneralHomesBlockService $funeralHomesBlockService
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $this->info('🚀 Iniciando geração de post...');

        try {
            $postIdea = $this->getPostIdea();

            if (! $postIdea) {
                $this->error('❌ Nenhuma ideia não utilizada encontrada.');

                return self::FAILURE;
            }

            $this->info("📝 Usando ideia: {$postIdea->title}");

            $this->info('🤖 Gerando conteúdo com ChatGPT...');
            $content = $this->chatGPTService->generatePostContent($postIdea->title);

            $this->info('✅ Conteúdo gerado com sucesso!');
            $this->displayGeneratedContent($content);

            $this->info('🖼️ Buscando imagem no Unsplash...');
            $imageData = $this->unsplashService->searchAndDownloadImage($postIdea->title);

            if ($imageData) {
                $this->info("✅ Imagem baixada: {$imageData['local_path']}");
                $this->line("📸 Fotógrafo: {$imageData['photographer_name']} (@{$imageData['photographer_username']})");

                $this->unsplashService->triggerDownload($imageData['unsplash_id']);
            } else {
                $this->warn('⚠️ Não foi possível baixar imagem do Unsplash');
            }

            $this->info('🏢 Adicionando bloco de funerárias recomendadas...');
            $funeralHomesBlock = $this->funeralHomesBlockService->generateHtmlBlock();
            $fullContent = $content['content'].$funeralHomesBlock;

            $updateData = [
                'description' => $fullContent,
                'meta_title' => $content['meta_title'],
                'meta_description' => $content['meta_description'],
            ];

            if ($imageData) {
                $updateData['image'] = $imageData['local_path'];
            }

            $postIdea->update($updateData);

            $this->postIdeaService->markAsUsed($postIdea);
            $this->info("✅ Ideia marcada como utilizada: {$postIdea->title}");

            $this->info('🎉 Post gerado com sucesso!');

            return self::SUCCESS;

        } catch (\Exception $e) {
            $this->error("❌ Erro ao gerar post: {$e->getMessage()}");
            Log::error('GeneratePostCommand Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return self::FAILURE;
        }
    }

    private function getPostIdea(): ?PostIdea
    {
        $ideaId = $this->option('idea-id');

        if ($ideaId) {
            $postIdea = PostIdea::query()->find($ideaId);

            if (! $postIdea) {
                $this->error("❌ Ideia com ID {$ideaId} não encontrada.");

                return null;
            }

            if ($postIdea->is_used) {
                $this->error("❌ Ideia com ID {$ideaId} já foi utilizada.");

                return null;
            }

            return $postIdea;
        }

        return $this->postIdeaService->getRandomUnusedIdea();
    }

    private function displayGeneratedContent(array $content): void
    {
        $this->newLine();
        $this->info('📄 CONTEÚDO GERADO:');
        $this->newLine();

        $this->line("📌 <fg=green>Título:</fg=green> {$content['title']}");
        $this->line("🔗 <fg=blue>Slug:</fg=blue> {$content['slug']}");
        $this->line("🏷️ <fg=yellow>Meta Title:</fg=yellow> {$content['meta_title']}");
        $this->line("📝 <fg=cyan>Meta Description:</fg=cyan> {$content['meta_description']}");

        $this->newLine();
        $this->info('📖 PRÉVIA DO CONTEÚDO:');
        $this->line(substr($content['content'], 0, 500).'...');

        $this->newLine();
    }
}
