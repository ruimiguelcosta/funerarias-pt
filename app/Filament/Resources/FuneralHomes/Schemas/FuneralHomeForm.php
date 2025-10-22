<?php

namespace App\Filament\Resources\FuneralHomes\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Grid;
use Filament\Schemas\Schema;

class FuneralHomeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações Básicas')
                    ->schema([
                        TextInput::make('title')
                            ->label('Nome da Funerária')
                            ->required()
                            ->maxLength(255),
                        
                        TextInput::make('slug')
                            ->label('Slug')
                            ->maxLength(255)
                            ->helperText('Deixe vazio para gerar automaticamente'),
                        
                        TextInput::make('sub_title')
                            ->label('Subtítulo')
                            ->maxLength(255),
                        
                        Textarea::make('description')
                            ->label('Descrição')
                            ->rows(3),
                        
                        TextInput::make('category_name')
                            ->label('Categoria')
                            ->maxLength(255),
                    ])
                    ->columns(2),
                
                Section::make('Informações de Contato')
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
                    ->columns(2),
                
                Section::make('Localização')
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
                    ->columns(3),
                
                Section::make('Coordenadas Geográficas')
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
                    ->columns(2),
                
                Section::make('Informações Adicionais')
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
                    ->columns(3),
                
                Section::make('Status e Controles')
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
                    ->columns(4),
            ]);
    }
}
