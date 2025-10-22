<?php

namespace App\Filament\Resources\FuneralHomes;

use App\Filament\Resources\FuneralHomes\Pages\CreateFuneralHome;
use App\Filament\Resources\FuneralHomes\Pages\EditFuneralHome;
use App\Filament\Resources\FuneralHomes\Pages\ListFuneralHomes;
use App\Filament\Resources\FuneralHomes\Schemas\FuneralHomeForm;
use App\Filament\Resources\FuneralHomes\Tables\FuneralHomesTable;
use App\Models\FuneralHome;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FuneralHomeResource extends Resource
{
    protected static ?string $model = FuneralHome::class;

    protected static ?string $navigationLabel = 'Funerárias';

    protected static ?string $modelLabel = 'Funerária';

    protected static ?string $pluralModelLabel = 'Funerárias';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    public static function form(Schema $schema): Schema
    {
        return FuneralHomeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FuneralHomesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFuneralHomes::route('/'),
            'create' => CreateFuneralHome::route('/create'),
            'edit' => EditFuneralHome::route('/{record}/edit'),
        ];
    }
}
