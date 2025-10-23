<?php

namespace Tests\Feature;

use App\Models\PostIdea;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GeneratePostCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_generate_post_command_with_unused_idea(): void
    {
        \App\Models\FuneralHome::factory()->count(4)->create([
            'city_slug' => 'lisboa',
        ]);

        $postIdea = PostIdea::factory()->unused()->create([
            'title' => 'Teste de ideia para post',
            'category' => 'Teste',
        ]);

        $this->artisan('posts:generate')
            ->expectsOutput('🚀 Iniciando geração de post...')
            ->expectsOutput("📝 Usando ideia: {$postIdea->title}")
            ->expectsOutput('🤖 Gerando conteúdo com ChatGPT...')
            ->expectsOutput('✅ Conteúdo gerado com sucesso!')
            ->expectsOutput('🖼️ Buscando imagem no Unsplash...')
            ->expectsOutput('🏢 Adicionando bloco de funerárias recomendadas...')
            ->expectsOutput("✅ Ideia marcada como utilizada: {$postIdea->title}")
            ->expectsOutput('🎉 Post gerado com sucesso!')
            ->assertExitCode(0);

        $postIdea->refresh();
        $this->assertTrue($postIdea->is_used);
        $this->assertNotNull($postIdea->used_at);
        $this->assertNotNull($postIdea->description);
        $this->assertNotNull($postIdea->meta_title);
        $this->assertNotNull($postIdea->meta_description);
        $this->assertStringContainsString('Funerárias Recomendadas', $postIdea->description);
    }

    public function test_generate_post_command_with_specific_idea_id(): void
    {
        $postIdea = PostIdea::factory()->unused()->create([
            'title' => 'Ideia específica para teste',
            'category' => 'Teste',
        ]);

        $this->artisan("posts:generate --idea-id={$postIdea->id}")
            ->expectsOutput('🚀 Iniciando geração de post...')
            ->expectsOutput("📝 Usando ideia: {$postIdea->title}")
            ->assertExitCode(0);

        $postIdea->refresh();
        $this->assertTrue($postIdea->is_used);
    }

    public function test_generate_post_command_fails_when_no_unused_ideas(): void
    {
        PostIdea::factory()->used()->create();

        $this->artisan('posts:generate')
            ->expectsOutput('🚀 Iniciando geração de post...')
            ->expectsOutput('❌ Nenhuma ideia não utilizada encontrada.')
            ->assertExitCode(1);
    }

    public function test_generate_post_command_fails_with_invalid_idea_id(): void
    {
        $this->artisan('posts:generate --idea-id=999')
            ->expectsOutput('🚀 Iniciando geração de post...')
            ->expectsOutput('❌ Ideia com ID 999 não encontrada.')
            ->assertExitCode(1);
    }

    public function test_generate_post_command_fails_with_used_idea_id(): void
    {
        $postIdea = PostIdea::factory()->used()->create();

        $this->artisan("posts:generate --idea-id={$postIdea->id}")
            ->expectsOutput('🚀 Iniciando geração de post...')
            ->expectsOutput("❌ Ideia com ID {$postIdea->id} já foi utilizada.")
            ->assertExitCode(1);
    }
}
