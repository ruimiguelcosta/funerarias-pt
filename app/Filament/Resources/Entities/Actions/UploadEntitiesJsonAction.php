<?php

namespace App\Filament\Resources\Entities\Actions;

use App\Jobs\ImportEntitiesJob;
use App\Models\Tenant;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Illuminate\Http\UploadedFile;
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

                    $tenantId = $data['tenant_id'];
                    $batchSize = 50;
                    $totalEntities = count($entitiesData);
                    $batches = array_chunk($entitiesData, $batchSize);
                    $batchIndex = 0;

                    foreach ($batches as $batch) {
                        ImportEntitiesJob::dispatch($batch, $tenantId, $batchIndex);
                        $batchIndex++;
                    }

                    Log::info('Import de entidades iniciado', [
                        'total' => $totalEntities,
                        'batches' => count($batches),
                        'tenant' => $tenantId,
                    ]);

                    Notification::make()
                        ->title('Importação iniciada')
                        ->body("O ficheiro com {$totalEntities} entidades foi adicionado à fila de processamento. Verifique os logs para acompanhar o progresso.")
                        ->success()
                        ->send();

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
}
