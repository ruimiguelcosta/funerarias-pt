<?php

namespace App\Filament\Widgets;

use App\Models\Entity;
use App\Models\Tenant;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TenantsEntitiesStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $tenants = Tenant::query()->get();

        $stats = [];

        foreach ($tenants as $tenant) {
            $suggestedCount = Entity::query()
                ->where('tenant_id', $tenant->id)
                ->where('is_suggested', true)
                ->count();

            $acceptedCount = Entity::query()
                ->where('tenant_id', $tenant->id)
                ->where('is_accepted', true)
                ->count();

            $stats[] = Stat::make("Sugeridas - {$tenant->name}", $suggestedCount)
                ->description("Entidades sugeridas para {$tenant->name}")
                ->descriptionIcon('heroicon-m-light-bulb')
                ->color('warning');

            $stats[] = Stat::make("Aceites - {$tenant->name}", $acceptedCount)
                ->description("Entidades aceites para {$tenant->name}")
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success');
        }

        return $stats;
    }
}
