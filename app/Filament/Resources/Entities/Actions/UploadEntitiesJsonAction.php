<?php

namespace App\Filament\Resources\Entities\Actions;

use App\Models\Entity;
use App\Models\Tenant;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UploadEntitiesJsonAction
{
    public static function make(): Action
    {
        return Action::make('upload_json')
            ->label('Upload JSON')
            ->icon('heroicon-o-cloud-arrow-up')
            ->color('primary')
            ->form([
                Select::make('tenant_id')
                    ->label('Tenant')
                    ->options(Tenant::query()->pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->helperText('Seleciona o tenant para associar as entidades'),
                FileUpload::make('json_file')
                    ->label('Ficheiro JSON')
                    ->acceptedFileTypes(['application/json'])
                    ->required()
                    ->maxSize(10240)
                    ->helperText('Seleciona um ficheiro JSON com os dados das funerárias'),
            ])
            ->action(function (array $data): void {
                try {
                    $uploadedFile = $data['json_file'];
                    $jsonContent = '';

                    if ($uploadedFile instanceof UploadedFile) {
                        $jsonContent = $uploadedFile->getContent();
                    } elseif (is_string($uploadedFile)) {
                        if (Storage::disk('public')->exists($uploadedFile)) {
                            $jsonContent = Storage::disk('public')->get($uploadedFile);
                        } elseif (Storage::exists($uploadedFile)) {
                            $jsonContent = Storage::get($uploadedFile);
                        } else {
                            $filePath = storage_path('app/livewire-tmp/'.$uploadedFile);
                            if (file_exists($filePath)) {
                                $jsonContent = file_get_contents($filePath);
                            } else {
                                throw new \Exception('Ficheiro não encontrado: '.$uploadedFile);
                            }
                        }
                    }

                    if (empty($jsonContent)) {
                        throw new \Exception('Não foi possível ler o conteúdo do ficheiro');
                    }

                    $entitiesData = json_decode($jsonContent, true);

                    if (json_last_error() !== JSON_ERROR_NONE) {
                        throw new \Exception('Ficheiro JSON inválido: '.json_last_error_msg());
                    }

                    if (! is_array($entitiesData)) {
                        throw new \Exception('O ficheiro JSON deve conter um array de dados');
                    }

                    $importedCount = 0;
                    $updatedCount = 0;
                    $errors = [];
                    $tenantId = $data['tenant_id'];

                    DB::transaction(function () use ($entitiesData, $tenantId, &$importedCount, &$updatedCount, &$errors) {
                        foreach ($entitiesData as $index => $entityData) {
                            try {
                                $existingEntity = Entity::query()
                                    ->where('tenant_id', $tenantId)
                                    ->where(function ($query) use ($entityData) {
                                        $query->where('place_id', $entityData['placeId'] ?? null)
                                            ->orWhere('title', $entityData['title'] ?? null);
                                    })
                                    ->first();

                                $processedData = self::processEntityData($entityData);
                                $processedData['tenant_id'] = $tenantId;

                                if ($existingEntity) {
                                    $existingEntity->update($processedData);
                                    $updatedCount++;
                                } else {
                                    Entity::query()->create($processedData);
                                    $importedCount++;
                                }
                            } catch (\Exception $e) {
                                $errors[] = 'Linha '.($index + 1).': '.$e->getMessage();
                                Log::error('Erro ao processar entidade', [
                                    'index' => $index,
                                    'data' => $entityData,
                                    'error' => $e->getMessage(),
                                ]);
                            }
                        }
                    });

                    $message = 'Processamento concluído! ';
                    $message .= "Importadas: {$importedCount}, ";
                    $message .= "Atualizadas: {$updatedCount}";

                    if (! empty($errors)) {
                        $message .= '. Erros: '.count($errors);
                        Notification::make()
                            ->title('Upload concluído com erros')
                            ->body($message)
                            ->warning()
                            ->send();
                    } else {
                        Notification::make()
                            ->title('Upload concluído com sucesso')
                            ->body($message)
                            ->success()
                            ->send();
                    }

                } catch (\Exception $e) {
                    Log::error('Erro no upload de JSON', [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString(),
                    ]);

                    Notification::make()
                        ->title('Erro no upload')
                        ->body('Erro ao processar o ficheiro: '.$e->getMessage())
                        ->danger()
                        ->send();
                }
            })
            ->requiresConfirmation()
            ->modalHeading('Upload de Dados JSON')
            ->modalDescription('Esta ação irá importar/atualizar os dados das funerárias a partir do ficheiro JSON selecionado.')
            ->modalSubmitActionLabel('Processar Ficheiro');
    }

    private static function processEntityData(array $data): array
    {
        return [
            'title' => $data['title'] ?? null,
            'price' => $data['price'] ?? null,
            'category_name' => $data['categoryName'] ?? null,
            'address' => $data['address'] ?? null,
            'neighborhood' => $data['neighborhood'] ?? null,
            'street' => $data['street'] ?? null,
            'city' => $data['city'] ?? null,
            'postal_code' => $data['postalCode'] ?? null,
            'state' => $data['state'] ?? null,
            'country_code' => $data['countryCode'] ?? null,
            'phone' => $data['phone'] ?? null,
            'phone_unformatted' => $data['phoneUnformatted'] ?? null,
            'website' => $data['website'] ?? null,
            'description' => $data['description'] ?? null,
            'sub_title' => $data['subTitle'] ?? null,
            'located_in' => $data['locatedIn'] ?? null,
            'plus_code' => $data['plusCode'] ?? null,
            'latitude' => $data['location']['lat'] ?? null,
            'longitude' => $data['location']['lng'] ?? null,
            'permanently_closed' => $data['permanentlyClosed'] ?? false,
            'temporarily_closed' => $data['temporarilyClosed'] ?? false,
            'claim_this_business' => $data['claimThisBusiness'] ?? false,
            'place_id' => $data['placeId'] ?? null,
            'fid' => $data['fid'] ?? null,
            'cid' => $data['cid'] ?? null,
            'reviews_count' => $data['reviewsCount'] ?? null,
            'images_count' => $data['imagesCount'] ?? null,
            'total_score' => $data['totalScore'] ?? null,
            'image_url' => $data['imageUrl'] ?? null,
            'kgmid' => $data['kgmid'] ?? null,
            'url' => $data['url'] ?? null,
            'search_page_url' => $data['searchPageUrl'] ?? null,
            'search_string' => $data['searchString'] ?? null,
            'language' => $data['language'] ?? null,
            'rank' => $data['rank'] ?? null,
            'is_advertisement' => $data['isAdvertisement'] ?? false,
            'is_suggested' => $data['is_suggested'] ?? false,
            'is_accepted' => $data['is_accepted'] ?? false,
            'scraped_at' => isset($data['scrapedAt']) ? now() : null,
        ];
    }
}
