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
        
        $downloaded = $imageDownloadService->downloadAllPendingImages();
        
        $this->info("Successfully downloaded {$downloaded} images.");
        
        return Command::SUCCESS;
    }
}
