<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::active()->ordered()->withCount(['providers' => fn ($q) => $q->where('is_active', true)])->get();
        return view('web.categories.index', compact('categories'));
    }

    public function show(string $slug): View
    {
        $category = Category::active()->where('slug', $slug)->firstOrFail();

        $providers = $category->providers()
            ->active()
            ->ordered()
            ->paginate(12);

        return view('web.categories.show', compact('category', 'providers'));
    }
}
