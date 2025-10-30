<?php

namespace App\Filament\Resources\Entities\Pages;

use App\Filament\Resources\Entities\EntityResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;

class CreateEntity extends CreateRecord
{
    protected static string $resource = EntityResource::class;

    public function getMaxContentWidth(): Width
    {
        return Width::Full;
    }
}





