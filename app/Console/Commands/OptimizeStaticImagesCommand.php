<?php

namespace App\Console\Commands;

use App\Services\ImageOptimizationService;
use Illuminate\Console\Command;

class OptimizeStaticImagesCommand extends Command
{
    protected $signature = 'images:optimize-static';

    protected $description = 'Optimize static images in public/images directory';

    public function handle(ImageOptimizationService $service): int
    {
        $this->info('Optimizing static images...');
        
        $staticImages = [
            'home.jpg',
            'cruzes.jpg', 
            'cemiterio.jpg'
        ];
        
        $optimized = 0;
        
        foreach ($staticImages as $image) {
            $imagePath = public_path("images/{$image}");
            
            if (file_exists($imagePath)) {
                if ($service->optimizeLogo($imagePath)) {
                    $this->info("Optimized: {$image}");
                    $optimized++;
                } else {
                    $this->error("Failed to optimize: {$image}");
                }
            } else {
                $this->warn("Image not found: {$image}");
            }
        }
        
        $this->info("Optimized {$optimized} static images successfully!");
        
        return 0;
    }
}
