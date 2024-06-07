<?php
/*
use App\Http\Controllers\CrawlerController;

Route::get('/crawl', [CrawlerController::class, 'crawl'])->name('crawl');
Route::get('/', [CrawlerController::class, 'showForm']);
*/

/*
use App\Http\Controllers\ScrapingController;

Route::get('/scrape-form', [ScrapingController::class, 'showForm']);
Route::post('/scrape-links', [ScrapingController::class, 'scrape']);
*/

use App\Http\Controllers\ScraperController;

Route::get('/scrape', [ScraperController::class, 'scrape'])->name('scrape');
Route::get('/', [ScraperController::class, 'showForm']);








