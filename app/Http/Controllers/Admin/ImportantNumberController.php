<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImportantNumberRequest;
use App\Models\ImportantNumber;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ImportantNumberController extends Controller
{
    public function index(): View
    {
        $numbers = ImportantNumber::ordered()->paginate(20);
        return view('admin.important_numbers.index', compact('numbers'));
    }

    public function create(): View
    {
        $number = new ImportantNumber(['is_active' => true, 'sort_order' => 0]);
        return view('admin.important_numbers.create', compact('number'));
    }

    public function store(ImportantNumberRequest $request): RedirectResponse
    {
        ImportantNumber::create($this->withMirroredLegacyFields($request->validated()));
        return redirect()->route('admin.important-numbers.index')->with('success', 'Number created.');
    }

    public function edit(ImportantNumber $importantNumber): View
    {
        $number = $importantNumber;
        return view('admin.important_numbers.edit', compact('number'));
    }

    public function update(ImportantNumberRequest $request, ImportantNumber $importantNumber): RedirectResponse
    {
        $importantNumber->update($this->withMirroredLegacyFields($request->validated()));
        return redirect()->route('admin.important-numbers.index')->with('success', 'Number updated.');
    }

    public function destroy(ImportantNumber $importantNumber): RedirectResponse
    {
        $importantNumber->delete();
        return redirect()->route('admin.important-numbers.index')->with('success', 'Number deleted.');
    }

    /** Mirror `_en` back into legacy single-language columns. */
    private function withMirroredLegacyFields(array $data): array
    {
        foreach (['title', 'description'] as $field) {
            if (array_key_exists("{$field}_en", $data)) {
                $data[$field] = $data["{$field}_en"];
            }
        }
        return $data;
    }
}
