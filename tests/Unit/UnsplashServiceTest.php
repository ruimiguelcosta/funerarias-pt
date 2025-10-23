<?php

namespace Tests\Unit;

use App\Services\UnsplashService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UnsplashServiceTest extends TestCase
{
    private UnsplashService $service;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
        $this->service = new UnsplashService;
    }

    public function test_search_and_download_image_successfully(): void
    {
        Http::fake([
            'api.unsplash.com/search/photos*' => Http::response([
                'results' => [
                    [
                        'id' => 'test-photo-id',
                        'urls' => [
                            'regular' => 'https://images.unsplash.com/photo-123',
                        ],
                        'links' => [
                            'html' => 'https://unsplash.com/photos/test',
                        ],
                        'user' => [
                            'name' => 'Test Photographer',
                            'username' => 'testphotographer',
                            'links' => [
                                'html' => 'https://unsplash.com/@testphotographer',
                            ],
                        ],
                    ],
                ],
            ], 200),
            'images.unsplash.com/*' => Http::response('fake-image-content', 200),
        ]);

        $result = $this->service->searchAndDownloadImage('funeral services');

        $this->assertNotNull($result);
        $this->assertArrayHasKey('local_path', $result);
        $this->assertArrayHasKey('unsplash_id', $result);
        $this->assertArrayHasKey('photographer_name', $result);
        $this->assertEquals('test-photo-id', $result['unsplash_id']);
        $this->assertEquals('Test Photographer', $result['photographer_name']);
        $this->assertEquals('testphotographer', $result['photographer_username']);

        Storage::disk('public')->assertExists($result['local_path']);
    }

    public function test_returns_null_when_no_results_found(): void
    {
        Http::fake([
            'api.unsplash.com/search/photos*' => Http::response([
                'results' => [],
            ], 200),
        ]);

        $result = $this->service->searchAndDownloadImage('nonexistent query');

        $this->assertNull($result);
    }

    public function test_returns_null_when_api_fails(): void
    {
        Http::fake([
            'api.unsplash.com/search/photos*' => Http::response([], 500),
        ]);

        $result = $this->service->searchAndDownloadImage('test query');

        $this->assertNull($result);
    }

    public function test_returns_null_when_download_fails(): void
    {
        Http::fake([
            'api.unsplash.com/search/photos*' => Http::response([
                'results' => [
                    [
                        'id' => 'test-photo-id',
                        'urls' => [
                            'regular' => 'https://images.unsplash.com/photo-123',
                        ],
                        'links' => [
                            'html' => 'https://unsplash.com/photos/test',
                        ],
                        'user' => [
                            'name' => 'Test Photographer',
                            'username' => 'testphotographer',
                            'links' => [
                                'html' => 'https://unsplash.com/@testphotographer',
                            ],
                        ],
                    ],
                ],
            ], 200),
            'images.unsplash.com/*' => Http::response([], 500),
        ]);

        $result = $this->service->searchAndDownloadImage('test query');

        $this->assertNull($result);
    }

    public function test_trigger_download_calls_unsplash_api(): void
    {
        Http::fake();

        $this->service->triggerDownload('test-photo-id');

        Http::assertSent(function ($request) {
            return $request->url() === 'https://api.unsplash.com/photos/test-photo-id/download';
        });
    }
}
