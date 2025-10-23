<?php

namespace App\Console\Commands;

use App\Models\FuneralHome;
use App\Models\Image;
use Illuminate\Console\Command;

class MigrateFuneralHomeImages extends Command
{
    protected $signature = 'funeral-homes:migrate-images {--limit=100 : Number of funeral homes to process}';

    protected $description = 'Migrate image_url from funeral_homes table to images table';

    public function handle(): int
    {
        $limit = $this->option('limit');

        $this->info("Migrating images for {$limit} funeral homes...");

        $funeralHomes = FuneralHome::query()
            ->whereNotNull('image_url')
            ->where('image_url', '!=', '')
            ->limit($limit)
            ->get();

        if ($funeralHomes->isEmpty()) {
            $this->info('No funeral homes with images found.');

            return Command::SUCCESS;
        }

        $bar = $this->output->createProgressBar($funeralHomes->count());
        $bar->start();

        $migrated = 0;
        $skipped = 0;

        foreach ($funeralHomes as $funeralHome) {
            // Check if image already exists
            $existingImage = Image::query()
                ->where('funeral_home_id', $funeralHome->id)
                ->where('original_url', $funeralHome->image_url)
                ->first();

            if ($existingImage) {
                $skipped++;
            } else {
                Image::query()->create([
                    'funeral_home_id' => $funeralHome->id,
                    'original_url' => $funeralHome->image_url,
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
