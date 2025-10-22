<?php

namespace App\Console\Commands;

use App\Actions\Http\GenerateSitemapAction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateSitemapCommand extends Command
{
    protected $signature = 'sitemap:generate {--path=public/sitemap.xml : Path to save the sitemap}';

    protected $description = 'Generate and save sitemap.xml file';

    public function handle(): int
    {
        $this->info('Generating sitemap...');

        $action = new GenerateSitemapAction;
        $response = $action();

        $path = $this->option('path');
        $fullPath = base_path($path);

        File::put($fullPath, $response->getContent());

        $this->info("Sitemap generated successfully at: {$path}");
        $this->info('Total URLs: '.substr_count($response->getContent(), '<url>'));

        return self::SUCCESS;
    }
}
