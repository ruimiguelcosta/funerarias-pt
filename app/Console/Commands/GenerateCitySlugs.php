<?php

namespace App\Console\Commands;

use App\Models\Entity;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateCitySlugs extends Command
{
    protected $signature = 'entities:generate-city-slugs';

    protected $description = 'Generate city slugs for all entities';

    public function handle(): int
    {
        $this->info('Generating city slugs for entities...');

        $entities = Entity::query()
            ->whereNull('city_slug')
            ->whereNotNull('city')
            ->get();

        $bar = $this->output->createProgressBar($entities->count());
        $bar->start();

        foreach ($entities as $entity) {
            $citySlug = Str::slug($entity->city);
            $entity->update(['city_slug' => $citySlug]);
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('City slugs generated successfully!');

        return Command::SUCCESS;
    }
}
