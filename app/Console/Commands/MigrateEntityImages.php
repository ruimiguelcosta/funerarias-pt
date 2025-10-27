<?php

namespace App\Console\Commands;

use App\Models\Entity;
use App\Models\Image;
use Illuminate\Console\Command;

class MigrateEntityImages extends Command
{
    protected $signature = 'entities:migrate-images {--limit=100 : Number of entities to process}';

    protected $description = 'Migrate image_url from funeral_homes table to images table';

    public function handle(): int
    {
        $limit = $this->option('limit');

        $this->info("Migrating images for {$limit} entities...");

        $entities = Entity::query()
            ->whereNotNull('image_url')
            ->where('image_url', '!=', '')
            ->limit($limit)
            ->get();

        if ($entities->isEmpty()) {
            $this->info('No entities with images found.');

            return Command::SUCCESS;
        }

        $bar = $this->output->createProgressBar($entities->count());
        $bar->start();

        $migrated = 0;
        $skipped = 0;

        foreach ($entities as $entity) {
            // Check if image already exists
            $existingImage = Image::query()
                ->where('entity_id', $entity->id)
                ->where('original_url', $entity->image_url)
                ->first();

            if ($existingImage) {
                $skipped++;
            } else {
                Image::query()->create([
                    'entity_id' => $entity->id,
                    'original_url' => $entity->image_url,
                    'category' => 'main',
                    'is_downloaded' => false,
                ]);
                $migrated++;
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();

        $this->info('Migration completed!');
        $this->info("✅ Migrated: {$migrated}");
        $this->info("⏭️ Skipped: {$skipped}");

        return Command::SUCCESS;
    }
}
