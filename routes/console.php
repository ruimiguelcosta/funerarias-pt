<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule the funeral home description generation every 5 minutes
Schedule::command('funeral-homes:generate-descriptions --limit=3')
    ->everyFiveMinutes()
    ->withoutOverlapping()
    ->runInBackground();

// Schedule sitemap generation daily at 2 AM
Schedule::command('sitemap:generate')
    ->dailyAt('02:00')
    ->withoutOverlapping();

// Schedule automatic post generation every 2 days at 9 AM
Schedule::command('posts:generate')
    ->cron('0 9 */2 * *')
    ->withoutOverlapping()
    ->runInBackground();
