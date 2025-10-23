<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UnsplashService
{
    private string $accessKey;

    private string $baseUrl = 'https://api.unsplash.com';

    public function __construct()
    {
        $this->accessKey = config('services.unsplash.access_key') ?? '';
    }

    public function searchAndDownloadImage(string $query, string $category = 'posts'): ?array
    {
        $photoData = $this->searchPhoto($query);

        if (! $photoData) {
            return null;
        }

        $localPath = $this->downloadPhoto($photoData['urls']['regular'], $category);

        if (! $localPath) {
            return null;
        }

        return [
            'local_path' => $localPath,
            'unsplash_id' => $photoData['id'],
            'unsplash_url' => $photoData['links']['html'],
            'photographer_name' => $photoData['user']['name'],
            'photographer_username' => $photoData['user']['username'],
            'photographer_url' => $photoData['user']['links']['html'],
        ];
    }

    private function searchPhoto(string $query): ?array
    {
        $response = Http::timeout(30)
            ->withHeaders([
                'Authorization' => 'Client-ID '.$this->accessKey,
            ])
            ->get("{$this->baseUrl}/search/photos", [
                'query' => $query,
                'per_page' => 1,
                'orientation' => 'landscape',
                'content_filter' => 'high',
            ]);

        if (! $response->successful()) {
            Log::warning('Unsplash API Error', [
                'status' => $response->status(),
                'query' => $query,
            ]);

            return null;
        }

        $results = $response->json('results');

        return $results[0] ?? null;
    }

    private function downloadPhoto(string $url, string $category): ?string
    {
        $response = Http::timeout(30)->get($url);

        if (! $response->successful()) {
            return null;
        }

        $filename = Str::slug(now()->format('Y-m-d-His')).'-'.Str::random(8).'.jpg';
        $path = "images/{$category}/{$filename}";

        Storage::disk('public')->put($path, $response->body());

        return $path;
    }

    public function triggerDownload(string $unsplashId): void
    {
        Http::timeout(10)
            ->withHeaders([
                'Authorization' => 'Client-ID '.$this->accessKey,
            ])
            ->get("{$this->baseUrl}/photos/{$unsplashId}/download");
    }
}
