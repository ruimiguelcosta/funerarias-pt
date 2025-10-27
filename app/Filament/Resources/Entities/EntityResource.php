<?php

namespace App\Filament\Resources\Entities;

use App\Filament\Resources\Entities\Pages\CreateEntity;
use App\Filament\Resources\Entities\Pages\EditEntity;
use App\Filament\Resources\Entities\Pages\ListEntities;
use App\Filament\Resources\Entities\Schemas\EntityForm;
use App\Filament\Resources\Entities\Tables\EntitiesTable;
use App\Models\Entity;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EntityResource extends Resource
{
    protected static ?string $model = Entity::class;

    protected static ?string $navigationLabel = 'Entidades';

    protected static ?string $modelLabel = 'Entidade';

    protected static ?string $pluralModelLabel = 'Entidades';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    public static function form(Schema $schema): Schema
    {
        return EntityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EntitiesTable::configure($table);
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
            'index' => ListEntities::route('/'),
            'create' => CreateEntity::route('/create'),
            'edit' => EditEntity::route('/{record}/edit'),
        ];
    }
}
