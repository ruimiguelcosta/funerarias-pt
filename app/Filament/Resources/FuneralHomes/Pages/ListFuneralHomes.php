<?php

namespace App\Filament\Resources\FuneralHomes\Pages;

use App\Filament\Resources\FuneralHomes\Actions\UploadFuneralHomesJsonAction;
use App\Filament\Resources\FuneralHomes\FuneralHomeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFuneralHomes extends ListRecords
{
    protected static string $resource = FuneralHomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            UploadFuneralHomesJsonAction::make(),
        ];
    }
}
