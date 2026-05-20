<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProviderMediaRequest;
use App\Models\ProviderMedia;
use App\Models\ServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProviderMediaController extends Controller
{
    public function index(ServiceProvider $provider): View
    {
        $provider->load(['media' => fn ($q) => $q->orderBy('type')->ordered()]);
        return view('admin.provider_media.index', compact('provider'));
    }

    public function store(ProviderMediaRequest $request, ServiceProvider $provider): RedirectResponse
    {
        $files = $request->file('image');
        $files = is_array($files) ? $files : [$files];

        $type = $request->input('type');
        $titleEn = $request->input('title_en');
        $titleAr = $request->input('title_ar');
        $sort = (int) $request->input('sort_order', 0);
        $active = (bool) $request->input('is_active', true);

        foreach ($files as $file) {
            if (!$file) continue;
            ProviderMedia::create([
                'service_provider_id' => $provider->id,
                'type'                => $type,
                // Mirror title_en → legacy title for backward compat.
                'title'               => $titleEn,
                'title_en'            => $titleEn,
                'title_ar'            => $titleAr,
                'image'               => $file->store('providers/media', 'public'),
                'sort_order'          => $sort,
                'is_active'           => $active,
            ]);
        }

        return redirect()->route('admin.providers.media.index', $provider)
            ->with('success', 'Media uploaded.');
    }

    public function update(Request $request, ServiceProvider $provider, ProviderMedia $medium): RedirectResponse
    {
        $data = $request->validate([
            'type'       => 'required|in:gallery,menu,product,cover,banner',
            'title_en'   => 'nullable|string|max:255',
            'title_ar'   => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active'  => 'sometimes|boolean',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        // Mirror title_en → legacy title column for backward compat.
        if (array_key_exists('title_en', $data)) {
            $data['title'] = $data['title_en'];
        }

        if ($request->hasFile('image')) {
            if ($medium->image) Storage::disk('public')->delete($medium->image);
            $data['image'] = $request->file('image')->store('providers/media', 'public');
        }

        $medium->update($data);

        return redirect()->route('admin.providers.media.index', $provider)
            ->with('success', 'Media updated.');
    }

    public function destroy(ServiceProvider $provider, ProviderMedia $medium): RedirectResponse
    {
        if ($medium->image) Storage::disk('public')->delete($medium->image);
        $medium->delete();

        return redirect()->route('admin.providers.media.index', $provider)
            ->with('success', 'Media deleted.');
    }

    public function toggle(ServiceProvider $provider, ProviderMedia $medium): RedirectResponse
    {
        $medium->update(['is_active' => ! $medium->is_active]);
        return redirect()->route('admin.providers.media.index', $provider)
            ->with('success', 'Status changed.');
    }
}
