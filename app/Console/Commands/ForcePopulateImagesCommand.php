<?php

namespace App\Console\Commands;

use App\Models\FuneralHome;
use App\Models\Image;
use Illuminate\Console\Command;

class ForcePopulateImagesCommand extends Command
{
    protected $signature = 'images:force-populate {--limit=}';

    protected $description = 'Force populate images table from funeral homes, recreating all images';

    public function handle(): int
    {
        $this->info('Starting force image population process...');

        $limit = $this->option('limit');
        $query = FuneralHome::query()
            ->whereNotNull('image_url')
            ->where('image_url', '!=', '');

        if ($limit) {
            $query->limit((int) $limit);
        }

        $funeralHomes = $query->get();
        $total = $funeralHomes->count();

        $this->info("Found {$total} funeral homes with image URLs.");

        if ($total === 0) {
            $this->warn('No funeral homes with image URLs found.');

            return Command::SUCCESS;
        }

        $created = 0;
        $updated = 0;

        $progressBar = $this->output->createProgressBar($total);
        $progressBar->start();

        foreach ($funeralHomes as $funeralHome) {
            // Verificar se já existe uma imagem para esta funerária
            $existingImage = Image::query()
                ->where('funeral_home_id', $funeralHome->id)
                ->where('original_url', $funeralHome->image_url)
                ->first();

            if ($existingImage) {
                // Atualizar imagem existente para não baixada
                $existingImage->update([
                    'is_downloaded' => false,
                    'local_path' => null,
                    'filename' => null,
                    'mime_type' => null,
                    'file_size' => null,
                    'downloaded_at' => null,
                ]);
                $updated++;
            } else {
                // Criar nova imagem
                Image::create([
                    'funeral_home_id' => $funeralHome->id,
                    'original_url' => $funeralHome->image_url,
                    'category' => 'main',
                    'is_downloaded' => false,
                    'local_path' => null,
                    'filename' => null,
                    'mime_type' => null,
                    'file_size' => null,
                    'downloaded_at' => null,
                ]);
                $created++;
            }

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine();

        $this->info('Force image population completed:');
        $this->info("- Created: {$created} new images");
        $this->info("- Updated: {$updated} existing images");

        $totalImages = $created + $updated;
        if ($totalImages > 0) {
            $this->info("You can now run 'php artisan images:download' to download the {$totalImages} images.");
        }

        return Command::SUCCESS;
    }
}
