<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Schemas\Components\Select;
use Filament\Schemas\Components\Textarea;
use Filament\Schemas\Components\TextInput;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('key')
                    ->label('Chave')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText('Identificador único (ex: hero.title, features.subtitle)'),

                Select::make('group')
                    ->label('Grupo')
                    ->required()
                    ->options([
                        'general' => 'Geral',
                        'hero' => 'Hero Section',
                        'features' => 'Features',
                        'about' => 'Sobre',
                        'contact' => 'Contacto',
                        'footer' => 'Footer',
                        'meta' => 'Meta Tags',
                    ])
                    ->default('general')
                    ->helperText('Organizar configurações por secção'),

                Select::make('type')
                    ->label('Tipo')
                    ->required()
                    ->options([
                        'text' => 'Texto',
                        'textarea' => 'Texto Longo',
                        'url' => 'URL',
                        'email' => 'Email',
                        'tel' => 'Telefone',
                        'number' => 'Número',
                    ])
                    ->default('text')
                    ->reactive(),

                Textarea::make('value')
                    ->label('Valor')
                    ->rows(3)
                    ->maxLength(65535)
                    ->columnSpanFull(),

                Textarea::make('description')
                    ->label('Descrição')
                    ->rows(2)
                    ->maxLength(65535)
                    ->helperText('Descrição opcional do que esta configuração controla')
                    ->columnSpanFull(),
            ]);
    }
}
