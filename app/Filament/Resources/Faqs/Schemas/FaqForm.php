<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Schemas\Components\Textarea;
use Filament\Schemas\Components\TextInput;
use Filament\Schemas\Components\Toggle;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('question')
                    ->label('Pergunta')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                Textarea::make('answer')
                    ->label('Resposta')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),

                TextInput::make('order')
                    ->label('Ordem')
                    ->numeric()
                    ->default(0)
                    ->helperText('Define a ordem de exibição (menor número aparece primeiro)'),

                Toggle::make('is_active')
                    ->label('Ativo')
                    ->default(true)
                    ->helperText('FAQs inativas não aparecem no site'),
            ]);
    }
}
