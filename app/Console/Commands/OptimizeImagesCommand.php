<?php

namespace App\Console\Commands;

use App\Services\ImageOptimizationService;
use Illuminate\Console\Command;

class OptimizeImagesCommand extends Command
{
    protected $signature = 'images:optimize {--logo : Optimize logo only}';

    protected $description = 'Optimize all images by converting to WebP/AVIF and creating different sizes';

    public function handle(ImageOptimizationService $service): int
    {
        if ($this->option('logo')) {
            $this->info('Optimizing logo...');
            $logoPath = public_path('images/logo.png');

            if ($service->optimizeLogo($logoPath)) {
                $this->info('Logo optimized successfully!');
            } else {
                $this->error('Failed to optimize logo.');

                return 1;
            }
        } else {
            $this->info('Starting image optimization...');

            $optimized = $service->optimizeAllImages();

            $this->info("Optimized {$optimized} images successfully!");
        }

        return 0;
    }
}
