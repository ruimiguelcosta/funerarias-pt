<?php

namespace Tests\Feature\Pages;

use App\Models\Entity;
use Tests\TestCase;

class PageActionsTest extends TestCase
{
    public function test_displays_home_page_with_featured_funeral_homes(): void
    {
        Entity::factory()->count(10)->create();

        $this->get('/')
            ->assertStatus(200)
            ->assertViewIs('pages.home')
            ->assertViewHas('seoPage', 'home')
            ->assertViewHas('featuredEntitys');
    }

    public function test_displays_funeral_homes_page_with_pagination(): void
    {
        Entity::factory()->count(15)->create();

        $response = $this->get('/funerarias');

        $response->assertStatus(200)
            ->assertViewIs('pages.funeral-homes')
            ->assertViewHas('seoPage', 'funeral-homes')
            ->assertViewHas('funeralHomes');

        $entitys = $response->viewData('funeralHomes');
        $this->assertTrue($entitys->hasPages());
        $this->assertEquals(12, $entitys->perPage());
    }

    public function test_displays_city_funeral_homes_page(): void
    {
        $entity = Entity::factory()->create(['city_slug' => 'lisboa']);
        Entity::factory()->count(5)->create(['city_slug' => 'lisboa']);

        $this->get('/lisboa')
            ->assertStatus(200)
            ->assertViewIs('pages.city-funeral-homes')
            ->assertViewHas('seoPage', 'city-funeral-homes')
            ->assertViewHas('city')
            ->assertViewHas('funeralHomes');
    }

    public function test_returns_404_for_non_existent_city(): void
    {
        $this->get('/cidade-inexistente')
            ->assertStatus(404);
    }

    public function test_displays_funeral_home_detail_page(): void
    {
        $entity = Entity::factory()->create([
            'city_slug' => 'lisboa',
            'slug' => 'funeraria-exemplo',
        ]);

        $this->get('/lisboa/funeraria-exemplo')
            ->assertStatus(200)
            ->assertViewIs('pages.funeral-home-detail')
            ->assertViewHas('seoPage', 'funeral-home-detail')
            ->assertViewHas('funeralHome');
    }

    public function test_displays_about_page(): void
    {
        $this->get('/quem-somos')
            ->assertStatus(200)
            ->assertViewIs('pages.about')
            ->assertViewHas('seoPage', 'about');
    }

    public function test_displays_blog_post_detail_page(): void
    {
        $this->get('/post/123')
            ->assertStatus(200)
            ->assertViewIs('pages.blog-post-detail')
            ->assertViewHas('seoPage', 'blog-post')
            ->assertViewHas('id', 123);
    }

    public function test_displays_privacy_policy_page(): void
    {
        $this->get('/politica-privacidade')
            ->assertStatus(200)
            ->assertViewIs('pages.privacy-policy')
            ->assertViewHas('seoPage', 'privacy-policy');
    }

    public function test_displays_cookie_policy_page(): void
    {
        $this->get('/politica-cookies')
            ->assertStatus(200)
            ->assertViewIs('pages.cookie-policy')
            ->assertViewHas('seoPage', 'cookie-policy');
    }

    public function test_displays_terms_page(): void
    {
        $this->get('/termos')
            ->assertStatus(200)
            ->assertViewIs('pages.terms')
            ->assertViewHas('seoPage', 'terms');
    }

    public function test_displays_404_page_for_non_existent_routes(): void
    {
        $this->get('/rota/inexistente/com/muitos/segmentos')
            ->assertStatus(200)
            ->assertViewIs('pages.404')
            ->assertViewHas('seoPage', '404');
    }
}
