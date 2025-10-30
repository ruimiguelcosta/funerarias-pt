<?php

use App\Actions\Http\Api\GetMapFuneralHomesAction;
use App\Actions\Http\Api\GetNearbyFuneralHomesAction;
use App\Actions\Http\Api\StoreUserLocationAction;
use App\Actions\Http\GenerateSitemapAction;
use App\Actions\Http\Pages\AboutPageAction;
use App\Actions\Http\Pages\BlogPageAction;
use App\Actions\Http\Pages\BlogPostDetailPageAction;
use App\Actions\Http\Pages\CityFuneralHomesPageAction;
use App\Actions\Http\Pages\ContactPageAction;
use App\Actions\Http\Pages\CookiePolicyPageAction;
use App\Actions\Http\Pages\FuneralHomeDetailPageAction;
use App\Actions\Http\Pages\FuneralHomesPageAction;
use App\Actions\Http\Pages\HomePageAction;
use App\Actions\Http\Pages\NearbyMapPageAction;
use App\Actions\Http\Pages\NotFoundPageAction;
use App\Actions\Http\Pages\PrivacyPolicyPageAction;
use App\Actions\Http\Pages\TermsPageAction;
use App\Actions\Http\Pages\SearchPageAction;
use App\Actions\Http\Pages\SearchResultsPageAction;
use App\Actions\Http\Reviews\StoreReviewAction;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePageAction::class)->name('home');

Route::get('/api/nearby-funeral-homes', GetNearbyFuneralHomesAction::class)->name('api.nearby-funeral-homes');

Route::get('/api/map-funeral-homes', GetMapFuneralHomesAction::class)->name('api.map-funeral-homes');

Route::post('/api/user-location', StoreUserLocationAction::class)->name('api.store-user-location');

Route::get('/mapa-funerarias-proximas', NearbyMapPageAction::class)->name('nearby-map');

Route::get('/funerarias', FuneralHomesPageAction::class)->name('funeral-homes');

Route::get('/blog', BlogPageAction::class)->name('blog');

Route::get('/quem-somos', AboutPageAction::class)->name('about');

Route::get('/contactos', ContactPageAction::class)->name('contact');

Route::get('/post/{slug}', BlogPostDetailPageAction::class)->name('blog-post-detail');

Route::get('/politica-privacidade', PrivacyPolicyPageAction::class)->name('privacy-policy');

Route::get('/politica-cookies', CookiePolicyPageAction::class)->name('cookie-policy');

Route::get('/termos', TermsPageAction::class)->name('terms');

Route::post('/reviews', StoreReviewAction::class)->name('reviews.store');

Route::get('/sitemap.xml', GenerateSitemapAction::class)->name('sitemap');

Route::get('/pesquisa', SearchPageAction::class)->name('search');
Route::get('/pesquisa/resultados', SearchResultsPageAction::class)->name('search.results');

Route::get('/{citySlug}', CityFuneralHomesPageAction::class)->name('city-funeral-homes');

Route::get('/{citySlug}/{entitySlug}', FuneralHomeDetailPageAction::class)->name('entity-detail');

Route::fallback(NotFoundPageAction::class);
