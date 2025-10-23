<?php

namespace App\Filament\Resources\PostIdeas\Pages;

use App\Filament\Resources\PostIdeas\PostIdeaResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePostIdea extends CreateRecord
{
    protected static string $resource = PostIdeaResource::class;
}
