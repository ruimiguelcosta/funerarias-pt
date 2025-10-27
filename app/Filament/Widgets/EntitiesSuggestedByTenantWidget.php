<?php

namespace App\Filament\Widgets;

use App\Models\Entity;
use App\Models\Tenant;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EntitiesSuggestedByTenantWidget extends BaseWidget
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

            $stats[] = Stat::make("Entidades Sugeridas - {$tenant->name}", $suggestedCount)
                ->description("Entidades sugeridas para o tenant {$tenant->name}")
                ->descriptionIcon('heroicon-m-light-bulb')
                ->color('warning');
        }

        return $stats;
    }
}
