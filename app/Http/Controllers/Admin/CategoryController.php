<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::ordered()->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        $category = new Category(['is_active' => true, 'sort_order' => 0]);
        return view('admin.categories.create', compact('category'));
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $data = $this->withMirroredLegacyFields($request->validated());

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('categories/icons', 'public');
        }
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories/images', 'public');
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category created.');
    }

    /**
     * Mirror `_en` fields back into the legacy single-language columns
     * (e.g. `name = name_en`) so old code paths and the legacy NOT NULL
     * constraint on `name` keep working alongside the new bilingual data.
     */
    private function withMirroredLegacyFields(array $data): array
    {
        foreach (['name', 'description'] as $field) {
            if (array_key_exists("{$field}_en", $data)) {
                $data[$field] = $data["{$field}_en"];
            }
        }
        return $data;
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $data = $this->withMirroredLegacyFields($request->validated());

        if ($request->hasFile('icon')) {
            if ($category->icon) Storage::disk('public')->delete($category->icon);
            $data['icon'] = $request->file('icon')->store('categories/icons', 'public');
        }
        if ($request->hasFile('image')) {
            if ($category->image) Storage::disk('public')->delete($category->image);
            $data['image'] = $request->file('image')->store('categories/images', 'public');
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->icon) Storage::disk('public')->delete($category->icon);
        if ($category->image) Storage::disk('public')->delete($category->image);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted.');
    }
}
