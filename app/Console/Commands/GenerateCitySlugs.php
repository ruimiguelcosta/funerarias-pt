<?php

namespace App\Console\Commands;

use App\Models\FuneralHome;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateCitySlugs extends Command
{
    protected $signature = 'funeral-homes:generate-city-slugs';

    protected $description = 'Generate city slugs for all funeral homes';

    public function handle(): int
    {
        $this->info('Generating city slugs for funeral homes...');

        $funeralHomes = FuneralHome::query()
            ->whereNull('city_slug')
            ->whereNotNull('city')
            ->get();

        $bar = $this->output->createProgressBar($funeralHomes->count());
        $bar->start();

        foreach ($funeralHomes as $funeralHome) {
            $citySlug = Str::slug($funeralHome->city);
            $funeralHome->update(['city_slug' => $citySlug]);
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('City slugs generated successfully!');

        return Command::SUCCESS;
    }
}
