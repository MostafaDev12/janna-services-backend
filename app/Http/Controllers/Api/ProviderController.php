<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProviderDetailsResource;
use App\Http\Resources\ProviderMediaResource;
use App\Http\Resources\ProviderResource;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index(Request $request)
    {
        $providers = ServiceProvider::active()
            ->with('category')
            ->when($request->filled('category'), function ($q) use ($request) {
                $slug = $request->string('category');
                $q->whereHas('category', fn ($c) => $c->where('slug', $slug));
            })
            ->when($request->boolean('featured'), fn ($q) => $q->featured())
            ->when($request->filled('area_type'), fn ($q) => $q->where('area_type', $request->string('area_type')))
            ->when($request->filled('keyword'), function ($q) use ($request) {
                $kw = '%'.$request->string('keyword').'%';
                $q->where(fn ($w) => $w->where('name', 'like', $kw)
                    ->orWhere('short_description', 'like', $kw)
                    ->orWhere('description', 'like', $kw));
            })
            ->ordered()
            ->paginate(15);

        return ProviderResource::collection($providers);
    }

    public function show(string $slug)
    {
        $provider = ServiceProvider::active()
            ->with(['category', 'media' => fn ($q) => $q->active()->ordered()])
            ->where('slug', $slug)
            ->firstOrFail();

        return new ProviderDetailsResource($provider);
    }

    public function media(string $slug)
    {
        $provider = ServiceProvider::active()->where('slug', $slug)->firstOrFail();

        $media = $provider->media()->active()->ordered()->get();

        return ProviderMediaResource::collection($media);
    }
}
