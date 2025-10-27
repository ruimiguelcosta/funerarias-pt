<?php

namespace Tests\Feature;

use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TenantStatcounterTest extends TestCase
{
    use RefreshDatabase;

    public function test_tenant_without_statcounter_settings_returns_null(): void
    {
        $tenant = Tenant::factory()->create(['settings' => null]);

        $this->assertNull($tenant->getStatcounterProject());
        $this->assertNull($tenant->getStatcounterSecurity());
        $this->assertFalse($tenant->hasStatcounter());
    }

    public function test_tenant_with_partial_statcounter_settings_returns_null(): void
    {
        $tenant = Tenant::factory()->create([
            'settings' => [
                'statcounter' => [
                    'sc_project' => '13179476',
                ],
            ],
        ]);

        $this->assertNull($tenant->getStatcounterSecurity());
        $this->assertFalse($tenant->hasStatcounter());
    }

    public function test_tenant_with_full_statcounter_settings_returns_values(): void
    {
        $tenant = Tenant::factory()->create([
            'settings' => [
                'statcounter' => [
                    'sc_project' => '13179476',
                    'sc_security' => 'efddaf82',
                ],
            ],
        ]);

        $this->assertEquals('13179476', $tenant->getStatcounterProject());
        $this->assertEquals('efddaf82', $tenant->getStatcounterSecurity());
        $this->assertTrue($tenant->hasStatcounter());
    }

    public function test_tenant_can_update_statcounter_settings(): void
    {
        $tenant = Tenant::factory()->create(['settings' => null]);

        $this->assertFalse($tenant->hasStatcounter());

        $tenant->update([
            'settings' => [
                'statcounter' => [
                    'sc_project' => '12345678',
                    'sc_security' => 'new-security-key',
                ],
            ],
        ]);

        $this->assertEquals('12345678', $tenant->getStatcounterProject());
        $this->assertEquals('new-security-key', $tenant->getStatcounterSecurity());
        $this->assertTrue($tenant->hasStatcounter());
    }

    public function test_tenant_factory_with_statcounter_creates_correct_settings(): void
    {
        $tenant = Tenant::factory()->withStatcounter('12345678', 'test-key')->create();

        $this->assertEquals('12345678', $tenant->getStatcounterProject());
        $this->assertEquals('test-key', $tenant->getStatcounterSecurity());
        $this->assertTrue($tenant->hasStatcounter());
    }
}
