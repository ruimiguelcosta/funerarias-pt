<?php

namespace App\Console\Commands;

use App\Actions\Http\GenerateSitemapAction;
use App\Models\Tenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateSitemapCommand extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate sitemap.xml file for each active tenant';

    public function handle(): int
    {
        $this->info('Generating sitemaps for all active tenants...');

        $tenants = Tenant::query()
            ->where('is_enabled', true)
            ->get();

        if ($tenants->isEmpty()) {
            $this->warn('No active tenants found.');

            return self::FAILURE;
        }

        $action = new GenerateSitemapAction;
        $totalUrls = 0;

        foreach ($tenants as $tenant) {
            $this->info("Generating sitemap for tenant: {$tenant->name} ({$tenant->domain})");

            $response = $action($tenant);
            $sitemapContent = $response->getContent();

            $path = "public/sitemap-{$tenant->slug}.xml";
            $fullPath = base_path($path);

            File::put($fullPath, $sitemapContent);

            $urlCount = substr_count($sitemapContent, '<url>');
            $totalUrls += $urlCount;

            $this->info("  Sitemap generated: {$path} ({$urlCount} URLs)");
        }

        $this->info("Generated {$tenants->count()} sitemap(s) with {$totalUrls} total URLs.");

        return self::SUCCESS;
    }
}
