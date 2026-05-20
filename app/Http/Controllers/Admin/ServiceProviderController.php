<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceProviderRequest;
use App\Models\Category;
use App\Models\ServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ServiceProviderController extends Controller
{
    public function index(Request $request): View
    {
        $providers = ServiceProvider::with('category')
            ->when($request->filled('keyword'), function ($q) use ($request) {
                $kw = '%'.$request->string('keyword').'%';
                $q->where(fn ($w) => $w->where('name', 'like', $kw)
                    ->orWhere('phone', 'like', $kw)
                    ->orWhere('address', 'like', $kw));
            })
            ->when($request->filled('category'), fn ($q) => $q->where('category_id', $request->integer('category')))
            ->ordered()
            ->paginate(15)
            ->withQueryString();

        $categories = Category::ordered()->get();

        return view('admin.providers.index', compact('providers', 'categories'));
    }

    public function create(): View
    {
        $provider = new ServiceProvider([
            'is_active'  => true,
            'is_featured'=> false,
            'area_type'  => 'inside_compound',
            'sort_order' => 0,
        ]);
        $categories = Category::ordered()->get();
        return view('admin.providers.create', compact('provider', 'categories'));
    }

    public function store(ServiceProviderRequest $request): RedirectResponse
    {
        $data = $this->withMirroredLegacyFields($request->validated());

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('providers/covers', 'public');
        }
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('providers/logos', 'public');
        }

        $provider = ServiceProvider::create($data);

        return redirect()->route('admin.providers.edit', $provider)->with('success', 'Provider created.');
    }

    public function edit(ServiceProvider $provider): View
    {
        $categories = Category::ordered()->get();
        return view('admin.providers.edit', compact('provider', 'categories'));
    }

    public function update(ServiceProviderRequest $request, ServiceProvider $provider): RedirectResponse
    {
        $data = $this->withMirroredLegacyFields($request->validated());

        if ($request->hasFile('cover_image')) {
            if ($provider->cover_image) Storage::disk('public')->delete($provider->cover_image);
            $data['cover_image'] = $request->file('cover_image')->store('providers/covers', 'public');
        }
        if ($request->hasFile('logo')) {
            if ($provider->logo) Storage::disk('public')->delete($provider->logo);
            $data['logo'] = $request->file('logo')->store('providers/logos', 'public');
        }

        $provider->update($data);

        return redirect()->route('admin.providers.edit', $provider)->with('success', 'Provider updated.');
    }

    public function destroy(ServiceProvider $provider): RedirectResponse
    {
        foreach ($provider->media as $m) {
            if ($m->image) Storage::disk('public')->delete($m->image);
        }
        if ($provider->cover_image) Storage::disk('public')->delete($provider->cover_image);
        if ($provider->logo) Storage::disk('public')->delete($provider->logo);
        $provider->delete();

        return redirect()->route('admin.providers.index')->with('success', 'Provider deleted.');
    }

    /**
     * Mirror `_en` fields back into the legacy single-language columns so the
     * NOT NULL `name` constraint and any code still reading raw `$provider->name`
     * keep working alongside the new bilingual data.
     */
    private function withMirroredLegacyFields(array $data): array
    {
        foreach (['name', 'description', 'short_description', 'address', 'working_hours'] as $field) {
            if (array_key_exists("{$field}_en", $data)) {
                $data[$field] = $data["{$field}_en"];
            }
        }
        return $data;
    }
}
