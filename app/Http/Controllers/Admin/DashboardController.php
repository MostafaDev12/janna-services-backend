<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\ImportantNumber;
use App\Models\ProviderMedia;
use App\Models\ServiceProvider;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'categories'        => Category::count(),
            'providers'         => ServiceProvider::count(),
            'featured_providers'=> ServiceProvider::where('is_featured', true)->count(),
            'media'             => ProviderMedia::count(),
            'important_numbers' => ImportantNumber::count(),
            'banners'           => Banner::count(),
        ];

        $latestProviders = ServiceProvider::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestProviders'));
    }
}
