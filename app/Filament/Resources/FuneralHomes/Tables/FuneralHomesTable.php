<?php

namespace App\Filament\Resources\FuneralHomes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class FuneralHomesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Nome')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                
                TextColumn::make('category_name')
                    ->label('Categoria')
                    ->searchable()
                    ->sortable()
                    ->badge(),
                
                TextColumn::make('city')
                    ->label('Cidade')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('state')
                    ->label('Estado')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('phone')
                    ->label('Telefone')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('website')
                    ->label('Website')
                    ->url(fn ($record) => $record->website)
                    ->openUrlInNewTab()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('total_score')
                    ->label('Pontuação')
                    ->numeric(decimalPlaces: 1)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('reviews_count')
                    ->label('Avaliações')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                IconColumn::make('permanently_closed')
                    ->label('Fechada')
                    ->boolean()
                    ->trueIcon('heroicon-o-x-circle')
                    ->falseIcon('heroicon-o-check-circle')
                    ->trueColor('danger')
                    ->falseColor('success'),
                
                IconColumn::make('is_advertisement')
                    ->label('Anúncio')
                    ->boolean()
                    ->trueIcon('heroicon-o-megaphone')
                    ->falseIcon('heroicon-o-building-office')
                    ->trueColor('warning')
                    ->falseColor('gray'),
                
                TextColumn::make('scraped_at')
                    ->label('Última Atualização')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('state')
                    ->label('Estado')
                    ->options(function () {
                        return \App\Models\FuneralHome::query()
                            ->whereNotNull('state')
                            ->distinct()
                            ->pluck('state', 'state')
                            ->sort()
                            ->toArray();
                    }),
                
                SelectFilter::make('city')
                    ->label('Cidade')
                    ->options(function () {
                        return \App\Models\FuneralHome::query()
                            ->whereNotNull('city')
                            ->distinct()
                            ->pluck('city', 'city')
                            ->sort()
                            ->toArray();
                    }),
                
                TernaryFilter::make('permanently_closed')
                    ->label('Fechada Permanentemente'),
                
                TernaryFilter::make('is_advertisement')
                    ->label('É Anúncio'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('title')
            ->paginated([10, 25, 50, 100]);
    }
}
