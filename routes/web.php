<?php

use App\Http\Controllers\Admin\AppSettingController as AdminAppSettingController;
use App\Http\Controllers\Admin\BannerController as AdminBannerController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ImportantNumberController as AdminImportantNumberController;
use App\Http\Controllers\Admin\ProviderMediaController as AdminProviderMediaController;
use App\Http\Controllers\Admin\ServiceProviderController as AdminServiceProviderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Web\CategoryController as WebCategoryController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ImportantNumberController as WebImportantNumberController;
use App\Http\Controllers\Web\ProviderController as WebProviderController;
use App\Http\Controllers\Web\SearchController as WebSearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public website
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories', [WebCategoryController::class, 'index'])->name('web.categories.index');
Route::get('/categories/{slug}', [WebCategoryController::class, 'show'])->name('web.categories.show');
Route::get('/providers', [WebProviderController::class, 'index'])->name('web.providers.index');
Route::get('/providers/{slug}', [WebProviderController::class, 'show'])->name('web.providers.show');
Route::get('/search', WebSearchController::class)->name('web.search');
Route::get('/important-numbers', [WebImportantNumberController::class, 'index'])->name('web.important-numbers');

/*
|--------------------------------------------------------------------------
| Legal pages (public — required for Google Play submission)
|--------------------------------------------------------------------------
*/
Route::view('/terms-and-conditions', 'legal.terms')->name('legal.terms');
Route::view('/privacy-policy',       'legal.privacy')->name('legal.privacy');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Admin dashboard
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', AdminCategoryController::class)->except('show');

    Route::resource('providers', AdminServiceProviderController::class)
        ->parameters(['providers' => 'provider'])
        ->except('show');

    Route::prefix('providers/{provider}/media')->name('providers.media.')->group(function () {
        Route::get('/', [AdminProviderMediaController::class, 'index'])->name('index');
        Route::post('/', [AdminProviderMediaController::class, 'store'])->name('store');
        Route::put('/{medium}', [AdminProviderMediaController::class, 'update'])->name('update');
        Route::delete('/{medium}', [AdminProviderMediaController::class, 'destroy'])->name('destroy');
        Route::post('/{medium}/toggle', [AdminProviderMediaController::class, 'toggle'])->name('toggle');
    });

    Route::resource('important-numbers', AdminImportantNumberController::class)
        ->parameters(['important-numbers' => 'importantNumber'])
        ->except('show');

    Route::resource('banners', AdminBannerController::class)->except('show');

    Route::get('settings',  [AdminAppSettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings',  [AdminAppSettingController::class, 'update'])->name('settings.update');
    Route::delete('settings/logo', [AdminAppSettingController::class, 'clearLogo'])->name('settings.logo.clear');
    Route::delete('settings/icon', [AdminAppSettingController::class, 'clearIcon'])->name('settings.icon.clear');
    Route::delete('settings/apk',  [AdminAppSettingController::class, 'clearApk'])->name('settings.apk.clear');
});
