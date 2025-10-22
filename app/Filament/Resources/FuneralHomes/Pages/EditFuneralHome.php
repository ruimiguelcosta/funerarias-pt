<?php

namespace App\Filament\Resources\FuneralHomes\Pages;

use App\Filament\Resources\FuneralHomes\FuneralHomeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFuneralHome extends EditRecord
{
    protected static string $resource = FuneralHomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
