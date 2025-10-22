<?php

use App\Actions\Http\GenerateSitemapAction;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', function () {
    $featuredFuneralHomes = \App\Models\FuneralHome::query()
        ->with(['images', 'categories'])
        ->inRandomOrder()
        ->limit(9)
        ->get();
    
    return view('pages.home', [
        'seoPage' => 'home',
        'featuredFuneralHomes' => $featuredFuneralHomes
    ]);
})->name('home');

// Funeral homes pages
Route::get('/funerarias', function () {
    $funeralHomes = \App\Models\FuneralHome::query()
        ->with(['images', 'categories'])
        ->paginate(12);
    
    return view('pages.funeral-homes', [
        'funeralHomes' => $funeralHomes,
        'seoPage' => 'funeral-homes'
    ]);
})->name('funeral-homes');

// City funeral homes page
Route::get('/{citySlug}', function ($citySlug) {
    $city = \App\Models\FuneralHome::query()
        ->where('city_slug', $citySlug)
        ->first();
    
    if (!$city) {
        abort(404);
    }
    
    $funeralHomes = \App\Models\FuneralHome::query()
        ->with(['images', 'categories'])
        ->where('city_slug', $citySlug)
        ->paginate(12);
    
    return view('pages.city-funeral-homes', [
        'city' => $city,
        'funeralHomes' => $funeralHomes,
        'seoPage' => 'city-funeral-homes',
        'seoData' => ['city' => $city]
    ]);
})->name('city-funeral-homes');

Route::get('/{citySlug}/{funeralHomeSlug}', function ($citySlug, $funeralHomeSlug) {
    $funeralHome = \App\Models\FuneralHome::query()
        ->with(['reviews', 'images', 'categories'])
        ->where('city_slug', $citySlug)
        ->where('slug', $funeralHomeSlug)
        ->firstOrFail();
    
    return view('pages.funeral-home-detail', [
        'funeralHome' => $funeralHome,
        'seoPage' => 'funeral-home-detail',
        'seoData' => ['funeralHome' => $funeralHome]
    ]);
})->name('funeral-home-detail');

// About page
Route::get('/quem-somos', function () {
    return view('pages.about', [
        'seoPage' => 'about'
    ]);
})->name('about');

// Blog pages
Route::get('/post/{id}', function ($id) {
    $blogData = [
        'id' => $id,
        'title' => 'Artigo de Blog - Serviços Funerários',
        'excerpt' => 'Informações e orientações sobre serviços funerários.',
        'author' => 'Equipa Funerárias Portugal',
        'published_time' => now()->toISOString(),
        'image' => config('app.url') . '/images/default-blog.jpg'
    ];
    
    return view('pages.blog-post-detail', [
        'id' => $id,
        'seoPage' => 'blog-post',
        'seoData' => $blogData
    ]);
})->name('blog-post-detail');

// Legal pages
Route::get('/politica-privacidade', function () {
    return view('pages.privacy-policy', [
        'seoPage' => 'privacy-policy'
    ]);
})->name('privacy-policy');

Route::get('/politica-cookies', function () {
    return view('pages.cookie-policy', [
        'seoPage' => 'cookie-policy'
    ]);
})->name('cookie-policy');

// Reviews
Route::post('/reviews', [App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');

// Sitemap
Route::get('/sitemap.xml', GenerateSitemapAction::class)->name('sitemap');

// 404 page
Route::fallback(function () {
    return view('pages.404', [
        'seoPage' => '404'
    ]);
});
