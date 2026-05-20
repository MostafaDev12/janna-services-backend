<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProviderResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::active()
            ->ordered()
            ->withCount(['providers' => fn ($q) => $q->where('is_active', true)])
            ->get();

        return CategoryResource::collection($categories);
    }

    public function show(string $slug)
    {
        $category = Category::active()->where('slug', $slug)->firstOrFail();
        return new CategoryResource($category);
    }

    public function providers(string $slug)
    {
        $category = Category::active()->where('slug', $slug)->firstOrFail();

        $providers = $category->providers()
            ->active()
            ->with('category')
            ->ordered()
            ->paginate(15);

        return ProviderResource::collection($providers);
    }
}
