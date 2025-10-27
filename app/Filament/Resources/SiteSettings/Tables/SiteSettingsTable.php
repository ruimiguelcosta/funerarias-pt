<?php

namespace App\Filament\Resources\SiteSettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SiteSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')
                    ->label('Chave')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('bold'),

                TextColumn::make('group')
                    ->label('Grupo')
                    ->badge()
                    ->sortable()
                    ->colors([
                        'primary' => 'general',
                        'success' => 'hero',
                        'warning' => 'features',
                        'danger' => 'contact',
                        'info' => 'footer',
                    ]),

                TextColumn::make('value')
                    ->label('Valor')
                    ->searchable()
                    ->limit(50)
                    ->wrap(),

                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('group')
                    ->label('Grupo')
                    ->options([
                        'general' => 'Geral',
                        'hero' => 'Hero Section',
                        'features' => 'Features',
                        'about' => 'Sobre',
                        'contact' => 'Contacto',
                        'footer' => 'Footer',
                        'meta' => 'Meta Tags',
                    ]),

                SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'text' => 'Texto',
                        'textarea' => 'Texto Longo',
                        'url' => 'URL',
                        'email' => 'Email',
                        'tel' => 'Telefone',
                        'number' => 'Número',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('group')
            ->defaultGroup('group');
    }
}
