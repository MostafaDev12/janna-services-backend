<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProviderController extends Controller
{
    public function index(Request $request): View
    {
        $providers = ServiceProvider::active()
            ->with('category')
            ->when($request->filled('category'), function ($q) use ($request) {
                $q->whereHas('category', fn ($c) => $c->where('slug', $request->string('category')));
            })
            ->when($request->filled('area_type'), fn ($q) => $q->where('area_type', $request->string('area_type')))
            ->when($request->boolean('featured'), fn ($q) => $q->featured())
            ->when($request->filled('keyword'), function ($q) use ($request) {
                $kw = '%'.$request->string('keyword').'%';
                $q->where(fn ($w) => $w->where('name', 'like', $kw)
                    ->orWhere('short_description', 'like', $kw)
                    ->orWhere('description', 'like', $kw));
            })
            ->ordered()
            ->paginate(12)
            ->withQueryString();

        $categories = Category::active()->ordered()->get();

        return view('web.providers.index', compact('providers', 'categories'));
    }

    public function show(string $slug): View
    {
        $provider = ServiceProvider::active()
            ->with(['category', 'media' => fn ($q) => $q->active()->ordered()])
            ->where('slug', $slug)
            ->firstOrFail();

        $related = ServiceProvider::active()
            ->where('category_id', $provider->category_id)
            ->where('id', '!=', $provider->id)
            ->ordered()
            ->take(4)
            ->get();

        return view('web.providers.show', compact('provider', 'related'));
    }
}
