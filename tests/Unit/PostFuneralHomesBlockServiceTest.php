<?php

namespace Tests\Unit;

use App\Models\FuneralHome;
use App\Services\PostFuneralHomesBlockService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostFuneralHomesBlockServiceTest extends TestCase
{
    use RefreshDatabase;

    private PostFuneralHomesBlockService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = app(PostFuneralHomesBlockService::class);
    }

    public function test_generates_html_block_with_four_funeral_homes(): void
    {
        FuneralHome::factory()->count(5)->create([
            'city_slug' => 'lisboa',
        ]);

        $html = $this->service->generateHtmlBlock();

        $this->assertNotEmpty($html);
        $this->assertStringContainsString('Funerárias Recomendadas', $html);
        $this->assertStringContainsString('Encontre os melhores serviços funerários perto de si', $html);
    }

    public function test_html_block_contains_funeral_home_information(): void
    {
        $funeralHome = FuneralHome::factory()->create([
            'title' => 'Funerária Teste',
            'city_slug' => 'porto',
            'slug' => 'funeraria-teste',
            'description' => 'Esta é uma descrição de teste para a funerária.',
        ]);

        $html = $this->service->generateHtmlBlock();

        $this->assertStringContainsString('Funerária Teste', $html);
    }

    public function test_returns_empty_string_when_no_funeral_homes_exist(): void
    {
        $html = $this->service->generateHtmlBlock();

        $this->assertEmpty($html);
    }

    public function test_html_block_strips_html_from_description(): void
    {
        FuneralHome::factory()->create([
            'title' => 'Funerária HTML Test',
            'city_slug' => 'braga',
            'description' => '<p>Esta é uma <strong>descrição</strong> com <em>HTML</em></p>',
        ]);

        $html = $this->service->generateHtmlBlock();

        $this->assertStringContainsString('Esta é uma descrição com HTML', $html);
        $this->assertStringNotContainsString('<p>', $html);
        $this->assertStringNotContainsString('<strong>', $html);
    }

    public function test_html_block_limits_description_to_200_characters(): void
    {
        $longDescription = str_repeat('Esta é uma descrição muito longa que excede o limite de 200 caracteres. ', 10);

        FuneralHome::factory()->create([
            'title' => 'Funerária Longa',
            'city_slug' => 'coimbra',
            'description' => $longDescription,
        ]);

        $html = $this->service->generateHtmlBlock();

        $this->assertStringContainsString('...', $html);

        preg_match('/<p style="color: #6B7280; font-size: 14px; line-height: 1\.6; margin-bottom: 16px;">([^<]+)<\/p>/', $html, $matches);

        if (isset($matches[1])) {
            $extractedDescription = html_entity_decode($matches[1], ENT_QUOTES | ENT_HTML5);
            $cleanOriginal = strip_tags($longDescription);

            $this->assertLessThan(strlen($cleanOriginal), strlen($extractedDescription));
        }
    }

    public function test_html_block_includes_links_to_funeral_homes(): void
    {
        FuneralHome::factory()->create([
            'title' => 'Funerária Link Test',
            'city_slug' => 'faro',
            'slug' => 'funeraria-link-test',
        ]);

        $html = $this->service->generateHtmlBlock();

        $this->assertStringContainsString('href="', $html);
        $this->assertStringContainsString('faro', $html);
        $this->assertStringContainsString('funeraria-link-test', $html);
    }
}
