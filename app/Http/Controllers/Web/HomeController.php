<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\ImportantNumber;
use App\Models\ServiceProvider;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Category::active()->ordered()->take(12)->get();

        $featured = ServiceProvider::active()->featured()->with('category')->ordered()->take(8)->get();

        $banners = Banner::active()->ordered()->take(5)->get();

        $importantNumbers = ImportantNumber::active()->ordered()->take(6)->get();

        return view('web.home', compact('categories', 'featured', 'banners', 'importantNumbers'));
    }
}
