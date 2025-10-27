<?php

namespace App\Filament\Resources\Tenants\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class TenantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações do Tenant')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, ?string $state, callable $set): void {
                                if ($operation === 'create') {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Identificador único para URLs'),

                        TextInput::make('domain')
                            ->label('Domínio')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->url()
                            ->prefix('https://')
                            ->helperText('Domínio personalizado para este tenant'),

                        FileUpload::make('logo')
                            ->label('Logo')
                            ->image()
                            ->directory('tenants/logos')
                            ->visibility('public')
                            ->imageEditor()
                            ->maxSize(2048)
                            ->helperText('Tamanho máximo: 2MB'),

                        Toggle::make('is_enabled')
                            ->label('Ativo')
                            ->default(true)
                            ->helperText('Desative para suspender temporariamente o tenant'),
                    ])
                    ->columns(2),
            ]);
    }
}
