<?php

namespace Tests\Feature;

use App\Models\Faq;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaqTenantFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_faqs_are_automatically_assigned_to_current_tenant(): void
    {
        $tenant = Tenant::factory()->create([
            'domain' => 'http://funerarias.test',
            'is_enabled' => true,
        ]);

        $this->get('http://funerarias.test/');

        $faq = Faq::factory()->create([
            'question' => 'Test Question',
        ]);

        $this->assertEquals($tenant->id, $faq->tenant_id);
    }

    public function test_only_tenant_faqs_are_queried(): void
    {
        $tenant1 = Tenant::factory()->create([
            'domain' => 'http://funerarias.test',
            'is_enabled' => true,
        ]);

        $tenant2 = Tenant::factory()->create([
            'domain' => 'http://outro-tenant.test',
            'is_enabled' => true,
        ]);

        Faq::factory()->count(5)->create(['tenant_id' => $tenant1->id]);
        Faq::factory()->count(3)->create(['tenant_id' => $tenant2->id]);

        $this->get('http://funerarias.test/');

        $faqsTenant1 = Faq::query()->get();

        $this->assertCount(5, $faqsTenant1);

        foreach ($faqsTenant1 as $faq) {
            $this->assertEquals($tenant1->id, $faq->tenant_id);
        }
    }

    public function test_different_tenants_cannot_see_each_others_faqs(): void
    {
        $tenant1 = Tenant::factory()->create([
            'domain' => 'http://funerarias.test',
            'is_enabled' => true,
        ]);

        $tenant2 = Tenant::factory()->create([
            'domain' => 'http://outro-tenant.test',
            'is_enabled' => true,
        ]);

        $faqsTenant1 = Faq::factory()->count(5)->create(['tenant_id' => $tenant1->id]);
        $faqsTenant2 = Faq::factory()->count(3)->create(['tenant_id' => $tenant2->id]);

        $this->get('http://funerarias.test/');

        $retrievedFaqs = Faq::query()->get();

        $this->assertCount(5, $retrievedFaqs);

        $tenant2Ids = $faqsTenant2->pluck('id')->toArray();
        foreach ($retrievedFaqs as $faq) {
            $this->assertNotContains($faq->id, $tenant2Ids);
        }
    }

    public function test_active_faqs_scope(): void
    {
        $tenant = Tenant::factory()->create([
            'domain' => 'http://funerarias.test',
            'is_enabled' => true,
        ]);

        $this->get('http://funerarias.test/');

        Faq::factory()->count(5)->create(['is_active' => true]);
        Faq::factory()->count(3)->create(['is_active' => false]);

        $activeFaqs = Faq::query()->where('is_active', true)->get();
        $inactiveFaqs = Faq::query()->where('is_active', false)->get();

        $this->assertCount(5, $activeFaqs);
        $this->assertCount(3, $inactiveFaqs);
    }

    public function test_faqs_are_ordered_correctly(): void
    {
        $tenant = Tenant::factory()->create([
            'domain' => 'http://funerarias.test',
            'is_enabled' => true,
        ]);

        $this->get('http://funerarias.test/');

        Faq::factory()->create(['order' => 3, 'question' => 'Third']);
        Faq::factory()->create(['order' => 1, 'question' => 'First']);
        Faq::factory()->create(['order' => 2, 'question' => 'Second']);

        $faqs = Faq::query()->orderBy('order')->get();

        $this->assertEquals('First', $faqs[0]->question);
        $this->assertEquals('Second', $faqs[1]->question);
        $this->assertEquals('Third', $faqs[2]->question);
    }
}
