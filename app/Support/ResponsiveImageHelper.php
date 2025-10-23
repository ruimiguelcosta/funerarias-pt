<?php

namespace App\Support;

use App\Models\Image;

class ResponsiveImageHelper
{
    public static function generatePictureElement(?Image $image, string $alt = '', string $class = '', array $sizes = []): string
    {
        if (! $image || ! $image->local_path) {
            return self::generateFallbackImage($alt, $class);
        }

        $defaultSizes = [
            '(max-width: 640px)' => 'small',
            '(max-width: 1024px)' => 'medium',
            'default' => 'large',
        ];

        $sizes = array_merge($defaultSizes, $sizes);

        $picture = '<picture>';

        foreach ($sizes as $media => $size) {
            if ($media === 'default') {
                $picture .= '<source srcset="'.$image->large_url.'" type="image/webp">';
                $picture .= '<source srcset="'.$image->local_url.'" type="image/jpeg">';
            } else {
                $picture .= '<source media="'.$media.'" srcset="'.$image->{$size.'_url'}.'" type="image/webp">';
            }
        }

        $picture .= '<img src="'.$image->local_url.'" alt="'.htmlspecialchars($alt).'" class="'.$class.'" loading="lazy" decoding="async">';
        $picture .= '</picture>';

        return $picture;
    }

    public static function generateOptimizedImg(?Image $image, string $alt = '', string $class = '', string $size = 'medium'): string
    {
        if (! $image || ! $image->local_path) {
            return self::generateFallbackImage($alt, $class);
        }

        $url = $image->{$size.'_url'} ?? $image->optimized_url ?? $image->local_url;

        return '<img src="'.$url.'" alt="'.htmlspecialchars($alt).'" class="'.$class.'" loading="lazy" decoding="async">';
    }

    public static function generateFallbackImage(string $alt = '', string $class = ''): string
    {
        $fallbackUrl = 'https://images.unsplash.com/photo-1584907797015-7554cd315667?w=400&h=300&fit=crop';

        return '<img src="'.$fallbackUrl.'" alt="'.htmlspecialchars($alt).'" class="'.$class.'" loading="lazy" decoding="async">';
    }

    public static function generateLogoPicture(string $class = ''): string
    {
        $logoPath = public_path('images/logo.png');
        $pathInfo = pathinfo($logoPath);
        $directory = $pathInfo['dirname'];
        $filename = $pathInfo['filename'];

        $webpPath = "{$directory}/{$filename}-small.webp";
        $avifPath = "{$directory}/{$filename}-small.avif";

        $picture = '<picture>';

        if (file_exists($avifPath)) {
            $picture .= '<source srcset="'.asset('images/'.basename($avifPath)).'" type="image/avif">';
        }

        if (file_exists($webpPath)) {
            $picture .= '<source srcset="'.asset('images/'.basename($webpPath)).'" type="image/webp">';
        }

        $picture .= '<img src="'.asset('images/logo.png').'" alt="Logo" class="'.$class.'">';
        $picture .= '</picture>';

        return $picture;
    }
}
