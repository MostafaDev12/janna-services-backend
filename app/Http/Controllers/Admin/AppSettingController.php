<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AppSettingRequest;
use App\Models\AppSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AppSettingController extends Controller
{
    public function edit(): View
    {
        $settings = AppSetting::current();
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(AppSettingRequest $request): RedirectResponse
    {
        $settings = AppSetting::current();

        $data = $request->validated();

        // Mirror EN → legacy single-language columns.
        if (array_key_exists('app_name_en', $data)) {
            $data['app_name'] = $data['app_name_en'];
        }
        if (array_key_exists('tagline_en', $data)) {
            $data['tagline'] = $data['tagline_en'];
        }

        if ($request->hasFile('logo')) {
            if ($settings->logo) Storage::disk('public')->delete($settings->logo);
            $data['logo'] = $request->file('logo')->store('settings', 'public');
        }
        if ($request->hasFile('icon')) {
            if ($settings->icon) Storage::disk('public')->delete($settings->icon);
            $data['icon'] = $request->file('icon')->store('settings', 'public');
        }

        $settings->update($data);

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated.');
    }

    public function clearLogo(): RedirectResponse
    {
        $s = AppSetting::current();
        if ($s->logo) Storage::disk('public')->delete($s->logo);
        $s->update(['logo' => null]);
        return back()->with('success', 'Logo removed.');
    }

    public function clearIcon(): RedirectResponse
    {
        $s = AppSetting::current();
        if ($s->icon) Storage::disk('public')->delete($s->icon);
        $s->update(['icon' => null]);
        return back()->with('success', 'Icon removed.');
    }
}
