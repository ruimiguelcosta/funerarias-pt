<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class ImageOptimizationService
{
    private ImageManager $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(new Driver);
    }

    public function optimizeImage(Image $image): bool
    {
        if (! $image->local_path || ! Storage::disk('public')->exists($image->local_path)) {
            return false;
        }

        $originalPath = Storage::disk('public')->path($image->local_path);
        $pathInfo = pathinfo($originalPath);
        $directory = $pathInfo['dirname'];
        $filename = $pathInfo['filename'];

        $optimized = $this->createOptimizedVersions($originalPath, $directory, $filename);

        if ($optimized) {
            $this->optimizeOriginal($originalPath);
        }

        return $optimized;
    }

    public function optimizeLogo(string $logoPath): bool
    {
        if (! file_exists($logoPath)) {
            return false;
        }

        $pathInfo = pathinfo($logoPath);
        $directory = $pathInfo['dirname'];
        $filename = $pathInfo['filename'];

        $this->createOptimizedVersions($logoPath, $directory, $filename);
        $this->optimizeOriginal($logoPath);

        return true;
    }

    private function createOptimizedVersions(string $originalPath, string $directory, string $filename): bool
    {
        $sizes = [
            'webp' => [
                'small' => [300, 200],
                'medium' => [600, 400],
                'large' => [1200, 800],
            ],
            'avif' => [
                'small' => [300, 200],
                'medium' => [600, 400],
                'large' => [1200, 800],
            ],
        ];

        $success = true;

        foreach ($sizes as $format => $sizeConfig) {
            foreach ($sizeConfig as $sizeName => $dimensions) {
                [$width, $height] = $dimensions;

                $outputPath = "{$directory}/{$filename}-{$sizeName}.{$format}";

                if (! $this->createResizedImage($originalPath, $outputPath, $width, $height, $format)) {
                    $success = false;
                }
            }
        }

        return $success;
    }

    private function createResizedImage(string $originalPath, string $outputPath, int $width, int $height, string $format): bool
    {
        try {
            $image = $this->imageManager->read($originalPath);

            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $image->toWebp(85)->save($outputPath);

            return true;
        } catch (\Exception $e) {
            \Log::error("Failed to create resized image {$outputPath}: ".$e->getMessage());

            return false;
        }
    }

    private function optimizeOriginal(string $path): void
    {
        try {
            $optimizerChain = OptimizerChainFactory::create();
            $optimizerChain->optimize($path);
        } catch (\Exception $e) {
            \Log::error("Failed to optimize original image {$path}: ".$e->getMessage());
        }
    }

    public function getOptimizedImageUrl(string $originalPath, string $size = 'medium', string $format = 'webp'): string
    {
        $pathInfo = pathinfo($originalPath);
        $directory = $pathInfo['dirname'];
        $filename = $pathInfo['filename'];

        $optimizedPath = "{$directory}/{$filename}-{$size}.{$format}";

        if (file_exists($optimizedPath)) {
            $relativePath = str_replace(public_path(), '', $optimizedPath);

            return asset($relativePath);
        }

        return $originalPath;
    }

    public function optimizeAllImages(): int
    {
        $images = Image::query()
            ->where('is_downloaded', true)
            ->whereNotNull('local_path')
            ->get();

        $optimized = 0;

        foreach ($images as $image) {
            if ($this->optimizeImage($image)) {
                $optimized++;
            }
        }

        return $optimized;
    }
}
