<?php

namespace App\Filament\Resources\PostIdeas\Pages;

use App\Filament\Resources\PostIdeas\PostIdeaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPostIdea extends EditRecord
{
    protected static string $resource = PostIdeaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
