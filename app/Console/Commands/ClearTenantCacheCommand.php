<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearTenantCacheCommand extends Command
{
    protected $signature = 'cache:clear-tenant {tenant_id?}';

    protected $description = 'Limpa o cache de um tenant específico ou de todos os tenants';

    public function handle(): int
    {
        $tenantId = $this->argument('tenant_id');

        if ($tenantId) {
            $this->clearTenantCache($tenantId);
            $this->info("Cache do tenant {$tenantId} limpo com sucesso!");
        } else {
            $tenants = Tenant::query()->get();

            foreach ($tenants as $tenant) {
                $this->clearTenantCache($tenant->id);
            }

            $this->info('Cache de todos os tenants limpo com sucesso!');
        }

        return self::SUCCESS;
    }

    private function clearTenantCache(int $tenantId): void
    {
        $cacheKeys = [
            "featured_entities_tenant_{$tenantId}",
            "active_faqs_tenant_{$tenantId}",
        ];

        foreach ($cacheKeys as $key) {
            Cache::forget($key);
        }
    }
}
