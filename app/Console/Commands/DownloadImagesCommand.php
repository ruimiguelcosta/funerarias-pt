<?php

namespace App\Console\Commands;

use App\Services\ImageDownloadService;
use Illuminate\Console\Command;

class DownloadImagesCommand extends Command
{
    protected $signature = 'images:download {--limit=}';

    protected $description = 'Download all pending images from remote URLs to local storage';

    public function handle(ImageDownloadService $imageDownloadService): int
    {
        $this->info('Starting image download process...');

        // Verificar quantas imagens estão pendentes
        $pendingCount = \App\Models\Image::query()
            ->where('is_downloaded', false)
            ->whereNotNull('original_url')
            ->count();

        $this->info("Found {$pendingCount} pending images to download.");

        if ($pendingCount === 0) {
            $this->warn('No pending images found. All images may already be downloaded.');

            // Verificar se há imagens marcadas como baixadas mas sem arquivo local
            $orphanedCount = \App\Models\Image::query()
                ->where('is_downloaded', true)
                ->whereNotNull('local_path')
                ->get()
                ->filter(function ($image) {
                    return ! \Illuminate\Support\Facades\Storage::disk('public')->exists($image->local_path);
                })->count();

            if ($orphanedCount > 0) {
                $this->warn("Found {$orphanedCount} images marked as downloaded but missing local files.");
                $this->info('Consider running: php artisan images:reset-orphaned');
            }

            return Command::SUCCESS;
        }

        $downloaded = $imageDownloadService->downloadAllPendingImages();

        $this->info("Successfully downloaded {$downloaded} images.");

        return Command::SUCCESS;
    }
}
