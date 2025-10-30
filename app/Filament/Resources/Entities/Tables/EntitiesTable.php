<?php

namespace App\Filament\Resources\Entities\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class EntitiesTable
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

                TextColumn::make('tenant.name')
                    ->label('Tenant')
                    ->searchable()
                    ->sortable()
                    ->badge(),

                TextColumn::make('city')
                    ->label('Cidade')
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

                IconColumn::make('is_suggested')
                    ->label('Sugerida')
                    ->boolean()
                    ->trueIcon('heroicon-o-light-bulb')
                    ->falseIcon('heroicon-o-light-bulb')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->action(function (Model $record) {
                        $record->update(['is_suggested' => ! $record->is_suggested]);
                    })
                    ->tooltip(fn (Model $record) => $record->is_suggested ? 'Clique para remover das sugestões' : 'Clique para marcar como sugerida'),

                IconColumn::make('is_accepted')
                    ->label('Aceite')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->action(function (Model $record) {
                        $record->update(['is_accepted' => ! $record->is_accepted]);
                    })
                    ->tooltip(fn (Model $record) => $record->is_accepted ? 'Clique para rejeitar' : 'Clique para aceitar'),

                IconColumn::make('copy_link')
                    ->label('Copiar Link')
                    ->state(true)
                    ->boolean()
                    ->trueIcon(Heroicon::ClipboardDocument)
                    ->falseIcon(Heroicon::ClipboardDocument)
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->action(function (Model $record, $livewire) {
                        $citySlug = $record->city_slug ?: ($record->city ? \Str::slug($record->city) : null);
                        $entitySlug = $record->slug;

                        if (empty($citySlug) || empty($entitySlug)) {
                            $livewire->js("\$wire.dispatch('notify', { message: 'Esta entidade não tem cidade/slug definidos.', type: 'danger' })");

                            return;
                        }

                        $url = route('entity-detail', [
                            'citySlug' => $citySlug,
                            'entitySlug' => $entitySlug,
                        ]);

                        $livewire->js("navigator.clipboard.writeText('{$url}').then(() => { \$wire.dispatch('notify', { message: 'Link copiado!', type: 'success' }); })");
                    })
                    ->tooltip('Clique para copiar o link desta entidade'),

                TextColumn::make('scraped_at')
                    ->label('Última Atualização')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('tenant_id')
                    ->label('Tenant')
                    ->relationship('tenant', 'name')
                    ->searchable()
                    ->preload(),

                TernaryFilter::make('is_suggested')
                    ->label('É Sugerida'),

                TernaryFilter::make('is_accepted')
                    ->label('É Aceite'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                $query->orderBy('is_suggested', 'asc')->orderBy('title', 'asc');
            })
            ->paginationPageOptions([10, 25, 50, 100])
            ->defaultPaginationPageOption(25)
            ->recordUrl(null);
    }
}
