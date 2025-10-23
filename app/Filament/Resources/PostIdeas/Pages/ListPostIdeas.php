<?php

namespace App\Filament\Resources\PostIdeas\Pages;

use App\Filament\Resources\PostIdeas\PostIdeaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPostIdeas extends ListRecords
{
    protected static string $resource = PostIdeaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
