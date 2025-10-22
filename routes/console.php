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
