<?php

namespace App\Filament\Resources\Entities\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class EntityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make()
                    ->tabs([
                        Tab::make('Informações Básicas')
                            ->schema([
                        TextInput::make('title')
                            ->label('Nome da Funerária')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('sub_title')
                            ->label('Subtítulo')
                            ->maxLength(255),

                        RichEditor::make('description')
                            ->label('Descrição')
                            ->columnSpanFull(),

                        TextInput::make('category_name')
                            ->label('Categoria')
                            ->maxLength(255),
                    ])
                            ->columns(2)
                            ->columnSpanFull(),

                        Tab::make('Contato')
                            ->schema([
                        TextInput::make('phone')
                            ->label('Telefone')
                            ->tel()
                            ->maxLength(255),

                        TextInput::make('phone_unformatted')
                            ->label('Telefone (sem formatação)')
                            ->maxLength(255),

                        TextInput::make('website')
                            ->label('Website')
                            ->url()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                    ])
                            ->columns(2)
                            ->columnSpanFull(),

                        Tab::make('Localização')
                            ->schema([
                        TextInput::make('address')
                            ->label('Endereço Completo')
                            ->maxLength(255),

                        TextInput::make('street')
                            ->label('Rua')
                            ->maxLength(255),

                        TextInput::make('neighborhood')
                            ->label('Bairro')
                            ->maxLength(255),

                        TextInput::make('city')
                            ->label('Cidade')
                            ->maxLength(255),

                        TextInput::make('state')
                            ->label('Estado')
                            ->maxLength(255),

                        TextInput::make('postal_code')
                            ->label('CEP')
                            ->maxLength(255),

                        TextInput::make('country_code')
                            ->label('Código do País')
                            ->maxLength(255),

                        TextInput::make('located_in')
                            ->label('Localizado em')
                            ->maxLength(255),

                        TextInput::make('plus_code')
                            ->label('Plus Code')
                            ->maxLength(255),
                    ])
                            ->columns(3)
                            ->columnSpanFull(),

                        Tab::make('Coordenadas')
                            ->schema([
                        TextInput::make('latitude')
                            ->label('Latitude')
                            ->numeric()
                            ->step(0.00000001),

                        TextInput::make('longitude')
                            ->label('Longitude')
                            ->numeric()
                            ->step(0.00000001),
                    ])
                            ->columns(2)
                            ->columnSpanFull(),

                        Tab::make('Informações Adicionais')
                            ->schema([
                        TextInput::make('price')
                            ->label('Preço')
                            ->maxLength(255),

                        TextInput::make('place_id')
                            ->label('Place ID')
                            ->maxLength(255),

                        TextInput::make('fid')
                            ->label('FID')
                            ->maxLength(255),

                        TextInput::make('cid')
                            ->label('CID')
                            ->maxLength(255),

                        TextInput::make('kgmid')
                            ->label('KGMID')
                            ->maxLength(255),

                        TextInput::make('url')
                            ->label('URL Original')
                            ->url()
                            ->maxLength(255),

                        TextInput::make('search_page_url')
                            ->label('URL da Página de Busca')
                            ->url()
                            ->maxLength(255),

                        TextInput::make('search_string')
                            ->label('String de Busca')
                            ->maxLength(255),

                        TextInput::make('language')
                            ->label('Idioma')
                            ->maxLength(255),

                        TextInput::make('rank')
                            ->label('Rank')
                            ->numeric(),
                    ])
                            ->columns(3)
                            ->columnSpanFull(),

                        Tab::make('Status e Controles')
                            ->schema([
                        Toggle::make('permanently_closed')
                            ->label('Fechada Permanentemente'),

                        Toggle::make('temporarily_closed')
                            ->label('Fechada Temporariamente'),

                        Toggle::make('claim_this_business')
                            ->label('Reivindicar Negócio'),

                        Toggle::make('is_advertisement')
                            ->label('É Anúncio'),

                        TextInput::make('reviews_count')
                            ->label('Número de Avaliações')
                            ->numeric(),

                        TextInput::make('images_count')
                            ->label('Número de Imagens')
                            ->numeric(),

                        TextInput::make('total_score')
                            ->label('Pontuação Total')
                            ->numeric()
                            ->step(0.1),

                        TextInput::make('image_url')
                            ->label('URL da Imagem Principal')
                            ->url()
                            ->maxLength(255),
                    ])
                            ->columns(4)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}





