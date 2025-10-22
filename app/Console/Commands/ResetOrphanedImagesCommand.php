<?php

namespace App\Console\Commands;

use App\Models\Image;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ResetOrphanedImagesCommand extends Command
{
    protected $signature = 'images:reset-orphaned';

    protected $description = 'Reset images that are marked as downloaded but missing local files';

    public function handle(): int
    {
        $this->info('Checking for orphaned images...');

        $orphanedImages = Image::query()
            ->where('is_downloaded', true)
            ->whereNotNull('local_path')
            ->get()
            ->filter(function ($image) {
                return ! Storage::disk('public')->exists($image->local_path);
            });

        $count = $orphanedImages->count();

        if ($count === 0) {
            $this->info('No orphaned images found.');

            return Command::SUCCESS;
        }

        $this->warn("Found {$count} orphaned images.");

        if ($this->confirm('Do you want to reset these images for re-download?')) {
            $orphanedImages->each(function ($image) {
                $image->update([
                    'is_downloaded' => false,
                    'local_path' => null,
                    'downloaded_at' => null,
                ]);
            });

            $this->info("Reset {$count} orphaned images. You can now run 'php artisan images:download' to re-download them.");
        }

        return Command::SUCCESS;
    }
}
