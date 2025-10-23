<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageDownloadService
{
    public function downloadImage(Image $image): bool
    {
        if ($image->is_downloaded) {
            return true;
        }

        try {
            $response = Http::timeout(30)->get($image->original_url);

            if (! $response->successful()) {
                return false;
            }

            $filename = $this->generateFilename($image, $response);
            $path = "images/funeral-homes/{$image->funeral_home_id}/{$filename}";

            Storage::disk('public')->put($path, $response->body());

            $image->update([
                'local_path' => $path,
                'filename' => $filename,
                'mime_type' => $response->header('Content-Type'),
                'file_size' => strlen($response->body()),
                'is_downloaded' => true,
                'downloaded_at' => now(),
            ]);

            $optimizationService = app(ImageOptimizationService::class);
            $optimizationService->optimizeImage($image);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function downloadAllPendingImages(): int
    {
        $images = Image::query()
            ->where('is_downloaded', false)
            ->whereNotNull('original_url')
            ->get();

        $downloaded = 0;
        $failed = 0;

        foreach ($images as $image) {
            try {
                if ($this->downloadImage($image)) {
                    $downloaded++;
                } else {
                    $failed++;
                    \Log::warning("Failed to download image {$image->id}: {$image->original_url}");
                }
            } catch (\Exception $e) {
                $failed++;
                \Log::error("Exception downloading image {$image->id}: ".$e->getMessage());
            }
        }

        if ($failed > 0) {
            \Log::info("Image download completed: {$downloaded} successful, {$failed} failed");
        }

        return $downloaded;
    }

    private function generateFilename(Image $image, Response $response): string
    {
        $extension = $this->getExtensionFromMimeType($response->header('Content-Type'));
        $slug = $image->funeralHome ? Str::slug($image->funeralHome->title) : 'image';

        return "{$slug}-{$image->id}.{$extension}";
    }

    private function getExtensionFromMimeType(?string $mimeType): string
    {
        return match ($mimeType) {
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
            default => 'jpg',
        };
    }
}
