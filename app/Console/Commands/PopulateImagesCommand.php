<?php

namespace App\Console\Commands;

use App\Models\Entity;
use App\Models\Image;
use Illuminate\Console\Command;

class PopulateImagesCommand extends Command
{
    protected $signature = 'images:populate {--limit=}';

    protected $description = 'Populate images table from entities image_url field';

    public function handle(): int
    {
        $this->info('Starting image population process...');

        $limit = $this->option('limit');
        $query = Entity::query()
            ->whereNotNull('image_url')
            ->where('image_url', '!=', '');

        if ($limit) {
            $query->limit((int) $limit);
        }

        $entities = $query->get();
        $total = $entities->count();

        $this->info("Found {$total} entities with image URLs.");

        if ($total === 0) {
            $this->warn('No entities with image URLs found.');

            return Command::SUCCESS;
        }

        $created = 0;
        $skipped = 0;

        $progressBar = $this->output->createProgressBar($total);
        $progressBar->start();

        foreach ($entities as $entity) {
            // Verificar se já existe uma imagem para esta funerária
            $existingImage = Image::query()
                ->where('entity_id', $entity->id)
                ->where('original_url', $entity->image_url)
                ->first();

            if ($existingImage) {
                $skipped++;
            } else {
                Image::create([
                    'entity_id' => $entity->id,
                    'original_url' => $entity->image_url,
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

        $this->info('Image population completed:');
        $this->info("- Created: {$created} new images");
        $this->info("- Skipped: {$skipped} existing images");

        if ($created > 0) {
            $this->info("You can now run 'php artisan images:download' to download the images.");
        }

        return Command::SUCCESS;
    }
}
