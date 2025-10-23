<?php

namespace App\Filament\Widgets;

use App\Models\PostIdea;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PostIdeasStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalIdeas = PostIdea::query()->count();
        $unusedIdeas = PostIdea::query()->where('is_used', false)->count();
        $usedIdeas = PostIdea::query()->where('is_used', true)->count();
        $categoriesCount = PostIdea::query()->distinct('category')->count('category');

        return [
            Stat::make('Total de Ideias', $totalIdeas)
                ->description('Ideias disponíveis no sistema')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),

            Stat::make('Ideias Não Utilizadas', $unusedIdeas)
                ->description('Ideias prontas para gerar posts')
                ->descriptionIcon('heroicon-m-clock')
                ->color('success'),

            Stat::make('Ideias Utilizadas', $usedIdeas)
                ->description('Ideias já convertidas em posts')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('warning'),

            Stat::make('Categorias', $categoriesCount)
                ->description('Diferentes categorias de conteúdo')
                ->descriptionIcon('heroicon-m-tag')
                ->color('info'),
        ];
    }
}
