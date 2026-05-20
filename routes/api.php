<?php

use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ImportantNumberController;
use App\Http\Controllers\Api\ProviderController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\SettingsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public REST endpoints for the Flutter mobile app
|--------------------------------------------------------------------------
*/

Route::get('/categories',                  [CategoryController::class, 'index']);
Route::get('/categories/{slug}',           [CategoryController::class, 'show']);
Route::get('/categories/{slug}/providers', [CategoryController::class, 'providers']);

Route::get('/providers',                   [ProviderController::class, 'index']);
Route::get('/providers/{slug}',            [ProviderController::class, 'show']);
Route::get('/providers/{slug}/media',      [ProviderController::class, 'media']);

Route::get('/search',                      SearchController::class);

Route::get('/important-numbers',           [ImportantNumberController::class, 'index']);
Route::get('/banners',                     [BannerController::class, 'index']);

Route::get('/settings',                    [SettingsController::class, 'index']);
