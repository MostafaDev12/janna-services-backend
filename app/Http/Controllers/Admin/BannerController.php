<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Models\Banner;
use App\Models\ServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BannerController extends Controller
{
    public function index(): View
    {
        $banners = Banner::with('provider')->ordered()->paginate(15);
        return view('admin.banners.index', compact('banners'));
    }

    public function create(): View
    {
        $banner = new Banner(['is_active' => true, 'sort_order' => 0]);
        $providers = ServiceProvider::ordered()->get(['id', 'name']);
        return view('admin.banners.create', compact('banner', 'providers'));
    }

    public function store(BannerRequest $request): RedirectResponse
    {
        $data = $this->withMirroredLegacyFields($request->validated());
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('banners', 'public');
        }
        Banner::create($data);
        return redirect()->route('admin.banners.index')->with('success', 'Banner created.');
    }

    public function edit(Banner $banner): View
    {
        $providers = ServiceProvider::ordered()->get(['id', 'name']);
        return view('admin.banners.edit', compact('banner', 'providers'));
    }

    public function update(BannerRequest $request, Banner $banner): RedirectResponse
    {
        $data = $this->withMirroredLegacyFields($request->validated());
        if ($request->hasFile('image')) {
            if ($banner->image) Storage::disk('public')->delete($banner->image);
            $data['image'] = $request->file('image')->store('banners', 'public');
        }
        $banner->update($data);
        return redirect()->route('admin.banners.index')->with('success', 'Banner updated.');
    }

    public function destroy(Banner $banner): RedirectResponse
    {
        if ($banner->image) Storage::disk('public')->delete($banner->image);
        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted.');
    }

    /** Mirror `_en` back into legacy single-language columns. */
    private function withMirroredLegacyFields(array $data): array
    {
        foreach (['title', 'subtitle'] as $field) {
            if (array_key_exists("{$field}_en", $data)) {
                $data[$field] = $data["{$field}_en"];
            }
        }
        return $data;
    }
}
