<?php

namespace Tests\Feature;

use App\Models\PostIdea;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostIdeaTenantFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_shows_only_posts_from_current_tenant(): void
    {
        $tenant1 = Tenant::factory()->create([
            'domain' => 'http://funerarias.test',
            'name' => 'Funerarias Portugal',
            'is_enabled' => true,
        ]);

        $tenant2 = Tenant::factory()->create([
            'domain' => 'http://outro-tenant.test',
            'name' => 'Outro Tenant',
            'is_enabled' => true,
        ]);

        PostIdea::factory()->count(5)->used()->create([
            'tenant_id' => $tenant1->id,
        ]);

        PostIdea::factory()->count(3)->used()->create([
            'tenant_id' => $tenant2->id,
        ]);

        $response = $this->get('http://funerarias.test/');

        $response->assertOk();

        $viewData = $response->viewData('featuredPosts');

        $this->assertNotEmpty($viewData);

        foreach ($viewData as $post) {
            $this->assertEquals($tenant1->id, $post->tenant_id);
        }
    }

    public function test_blog_page_shows_only_posts_from_current_tenant(): void
    {
        $tenant1 = Tenant::factory()->create([
            'domain' => 'http://funerarias.test',
            'name' => 'Funerarias Portugal',
            'is_enabled' => true,
        ]);

        $tenant2 = Tenant::factory()->create([
            'domain' => 'http://outro-tenant.test',
            'name' => 'Outro Tenant',
            'is_enabled' => true,
        ]);

        PostIdea::factory()->count(8)->used()->create([
            'tenant_id' => $tenant1->id,
        ]);

        PostIdea::factory()->count(5)->used()->create([
            'tenant_id' => $tenant2->id,
        ]);

        $response = $this->get('http://funerarias.test/blog');

        $response->assertOk();

        $posts = $response->viewData('posts');

        $this->assertEquals(8, $posts->total());

        foreach ($posts as $post) {
            $this->assertEquals($tenant1->id, $post->tenant_id);
        }
    }

    public function test_different_tenants_cannot_see_each_others_posts(): void
    {
        $tenant1 = Tenant::factory()->create([
            'domain' => 'http://funerarias.test',
            'is_enabled' => true,
        ]);

        $tenant2 = Tenant::factory()->create([
            'domain' => 'http://outro-tenant.test',
            'is_enabled' => true,
        ]);

        $postTenant1 = PostIdea::factory()->used()->create([
            'tenant_id' => $tenant1->id,
            'slug' => 'post-teste-tenant-1',
        ]);

        $postTenant2 = PostIdea::factory()->used()->create([
            'tenant_id' => $tenant2->id,
            'slug' => 'post-teste-tenant-2',
        ]);

        $response = $this->get('http://funerarias.test/post/post-teste-tenant-2');

        $response->assertNotFound();

        $response = $this->get('http://funerarias.test/post/post-teste-tenant-1');

        $response->assertOk();
    }

    public function test_post_ideas_are_automatically_assigned_to_current_tenant(): void
    {
        $tenant = Tenant::factory()->create([
            'domain' => 'http://funerarias.test',
            'is_enabled' => true,
        ]);

        $this->get('http://funerarias.test/');

        $post = PostIdea::factory()->create([
            'title' => 'Test Post',
        ]);

        $this->assertEquals($tenant->id, $post->tenant_id);
    }

    public function test_only_tenant_posts_are_queried(): void
    {
        $tenant1 = Tenant::factory()->create([
            'domain' => 'http://funerarias.test',
            'is_enabled' => true,
        ]);

        $tenant2 = Tenant::factory()->create([
            'domain' => 'http://outro-tenant.test',
            'is_enabled' => true,
        ]);

        PostIdea::factory()->count(5)->create(['tenant_id' => $tenant1->id]);
        PostIdea::factory()->count(3)->create(['tenant_id' => $tenant2->id]);

        $this->get('http://funerarias.test/');

        $postsTenant1 = PostIdea::query()->get();

        $this->assertCount(5, $postsTenant1);

        foreach ($postsTenant1 as $post) {
            $this->assertEquals($tenant1->id, $post->tenant_id);
        }
    }
}
