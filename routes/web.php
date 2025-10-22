<?php

use App\Actions\Http\GenerateSitemapAction;
use App\Actions\Http\Pages\AboutPageAction;
use App\Actions\Http\Pages\BlogPostDetailPageAction;
use App\Actions\Http\Pages\CityFuneralHomesPageAction;
use App\Actions\Http\Pages\CookiePolicyPageAction;
use App\Actions\Http\Pages\FuneralHomeDetailPageAction;
use App\Actions\Http\Pages\FuneralHomesPageAction;
use App\Actions\Http\Pages\HomePageAction;
use App\Actions\Http\Pages\NotFoundPageAction;
use App\Actions\Http\Pages\PrivacyPolicyPageAction;
use App\Actions\Http\Reviews\StoreReviewAction;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePageAction::class)->name('home');

Route::get('/funerarias', FuneralHomesPageAction::class)->name('funeral-homes');

Route::get('/quem-somos', AboutPageAction::class)->name('about');

Route::get('/post/{id}', BlogPostDetailPageAction::class)->name('blog-post-detail');

Route::get('/politica-privacidade', PrivacyPolicyPageAction::class)->name('privacy-policy');

Route::get('/politica-cookies', CookiePolicyPageAction::class)->name('cookie-policy');

Route::post('/reviews', StoreReviewAction::class)->name('reviews.store');

Route::get('/sitemap.xml', GenerateSitemapAction::class)->name('sitemap');

Route::get('/{citySlug}', CityFuneralHomesPageAction::class)->name('city-funeral-homes');

Route::get('/{citySlug}/{funeralHomeSlug}', FuneralHomeDetailPageAction::class)->name('funeral-home-detail');

Route::fallback(NotFoundPageAction::class);
