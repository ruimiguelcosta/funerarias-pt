<?php

namespace App\Filament\Resources\PostIdeas;

use App\Filament\Resources\PostIdeas\Pages\CreatePostIdea;
use App\Filament\Resources\PostIdeas\Pages\EditPostIdea;
use App\Filament\Resources\PostIdeas\Pages\ListPostIdeas;
use App\Models\PostIdea;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PostIdeaResource extends Resource
{
    protected static ?string $model = PostIdea::class;

    protected static ?string $navigationLabel = 'Ideias de Posts';

    protected static ?string $modelLabel = 'Ideia de Post';

    protected static ?string $pluralModelLabel = 'Ideias de Posts';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Informações da Ideia')
                    ->schema([
                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        RichEditor::make('description')
                            ->label('Descrição')
                            ->columnSpanFull()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('post-ideas')
                            ->fileAttachmentsVisibility('public')
                            ->extraInputAttributes([
                                'style' => 'min-height: 400px !important; height: 400px !important;',
                            ]),

                        TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->maxLength(60)
                            ->helperText('Título otimizado para SEO (máximo 60 caracteres)')
                            ->columnSpanFull(),

                        Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->rows(3)
                            ->maxLength(160)
                            ->helperText('Descrição otimizada para SEO (máximo 160 caracteres)')
                            ->columnSpanFull(),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'waiting' => 'Aguardando',
                                'processed' => 'Processado',
                            ])
                            ->default('waiting')
                            ->required()
                            ->columnSpan(1),

                        Select::make('category')
                            ->label('Categoria')
                            ->options([
                                'Guias e Informação Prática' => 'Guias e Informação Prática',
                                'Serviços e Processos' => 'Serviços e Processos',
                                'Apoio Emocional e Luto' => 'Apoio Emocional e Luto',
                                'Sustentabilidade e Inovação' => 'Sustentabilidade e Inovação',
                                'Tradições, Cultura e História' => 'Tradições, Cultura e História',
                                'Conteúdo Local e Comparativo' => 'Conteúdo Local e Comparativo',
                            ])
                            ->searchable()
                            ->columnSpan(1),

                        FileUpload::make('image')
                            ->label('Imagem')
                            ->image()
                            ->disk('public')
                            ->directory('post-ideas')
                            ->visibility('public')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),

                ImageColumn::make('image')
                    ->label('Imagem')
                    ->circular()
                    ->size(50)
                    ->toggleable(),

                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        return strlen($state) > 50 ? $state : null;
                    }),

                TextColumn::make('meta_title')
                    ->label('Meta Title')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        return strlen($state) > 50 ? $state : null;
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('meta_description')
                    ->label('Meta Description')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        return strlen($state) > 50 ? $state : null;
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('category')
                    ->label('Categoria')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Guias e Informação Prática' => 'info',
                        'Serviços e Processos' => 'success',
                        'Apoio Emocional e Luto' => 'warning',
                        'Sustentabilidade e Inovação' => 'primary',
                        'Tradições, Cultura e História' => 'secondary',
                        'Conteúdo Local e Comparativo' => 'gray',
                        default => 'gray',
                    })
                    ->sortable()
                    ->searchable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'waiting' => 'warning',
                        'processed' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'waiting' => 'Aguardando',
                        'processed' => 'Processado',
                        default => $state,
                    })
                    ->sortable(),

                IconColumn::make('is_used')
                    ->label('Utilizada')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('used_at')
                    ->label('Data de Uso')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->placeholder('Não utilizada'),

                TextColumn::make('created_at')
                    ->label('Criada em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Atualizada em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Categoria')
                    ->options([
                        'Guias e Informação Prática' => 'Guias e Informação Prática',
                        'Serviços e Processos' => 'Serviços e Processos',
                        'Apoio Emocional e Luto' => 'Apoio Emocional e Luto',
                        'Sustentabilidade e Inovação' => 'Sustentabilidade e Inovação',
                        'Tradições, Cultura e História' => 'Tradições, Cultura e História',
                        'Conteúdo Local e Comparativo' => 'Conteúdo Local e Comparativo',
                    ]),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'waiting' => 'Aguardando',
                        'processed' => 'Processado',
                    ]),

                SelectFilter::make('is_used')
                    ->label('Utilizada')
                    ->options([
                        '0' => 'Não Utilizada',
                        '1' => 'Utilizada',
                    ]),
            ])
            ->recordActions([
                Action::make('generate_post')
                    ->label('Gerar Post')
                    ->icon('heroicon-o-sparkles')
                    ->color('success')
                    ->visible(fn (PostIdea $record): bool => ! $record->is_used)
                    ->requiresConfirmation()
                    ->modalHeading('Gerar Post com ChatGPT')
                    ->modalDescription('Esta ação irá gerar um post completo usando esta ideia e marcar como utilizada.')
                    ->action(function (PostIdea $record) {
                        \Artisan::call('posts:generate', ['--idea-id' => $record->id]);

                        $record->refresh();

                        \Filament\Notifications\Notification::make()
                            ->title('Post gerado com sucesso!')
                            ->body("O post foi gerado usando a ideia: {$record->title}")
                            ->success()
                            ->send();
                    }),

                Action::make('mark_as_unused')
                    ->label('Marcar como Não Utilizada')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('warning')
                    ->visible(fn (PostIdea $record): bool => $record->is_used)
                    ->requiresConfirmation()
                    ->modalHeading('Marcar como Não Utilizada')
                    ->modalDescription('Esta ação irá marcar esta ideia como não utilizada, permitindo que seja usada novamente.')
                    ->action(function (PostIdea $record) {
                        $record->update([
                            'is_used' => false,
                            'used_at' => null,
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('Ideia marcada como não utilizada')
                            ->body("A ideia '{$record->title}' pode ser usada novamente.")
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => ListPostIdeas::route('/'),
            'create' => CreatePostIdea::route('/create'),
            'edit' => EditPostIdea::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes();
    }
}
