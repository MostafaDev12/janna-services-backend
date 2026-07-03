@extends('admin.layouts.app')
@section('title', 'App settings')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="mb-3">App branding</h5>
        <p class="text-muted small">These values are returned by <code>GET /api/settings</code> and used by the Flutter app for the splash and home screens.</p>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">App name (English)</label>
                    <input type="text" name="app_name_en" class="form-control" value="{{ old('app_name_en', $settings->app_name_en ?? $settings->app_name) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">اسم التطبيق (بالعربية)</label>
                    <input type="text" name="app_name_ar" class="form-control" dir="rtl" value="{{ old('app_name_ar', $settings->app_name_ar) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tagline (English)</label>
                    <input type="text" name="tagline_en" class="form-control" maxlength="255" value="{{ old('tagline_en', $settings->tagline_en ?? $settings->tagline) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">الشعار النصي (بالعربية)</label>
                    <input type="text" name="tagline_ar" class="form-control" maxlength="255" dir="rtl" value="{{ old('tagline_ar', $settings->tagline_ar) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Logo (used on splash and home)</label>
                    <input type="file" name="logo" class="form-control" accept="image/*">
                    @if ($settings->logo)
                        <div class="mt-2 d-flex align-items-center gap-2">
                            <img src="{{ $settings->logo_url }}" class="img-preview" style="max-height:80px;background:#f5f6fa;padding:6px;border:1px solid #e5e7eb">
                            <form action="{{ route('admin.settings.logo.clear') }}" method="POST" onsubmit="return confirm('Remove current logo?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Remove</button>
                            </form>
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <label class="form-label">Icon (small square mark)</label>
                    <input type="file" name="icon" class="form-control" accept="image/*">
                    @if ($settings->icon)
                        <div class="mt-2 d-flex align-items-center gap-2">
                            <img src="{{ $settings->icon_url }}" class="img-preview" style="max-height:60px;background:#f5f6fa;padding:6px;border:1px solid #e5e7eb">
                            <form action="{{ route('admin.settings.icon.clear') }}" method="POST" onsubmit="return confirm('Remove current icon?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Remove</button>
                            </form>
                        </div>
                    @endif
                </div>

                <div class="col-md-3">
                    <label class="form-label">Primary color</label>
                    <input type="text" name="primary_color" class="form-control" placeholder="#0F4C45" value="{{ old('primary_color', $settings->primary_color) }}">
                    <small class="text-muted">Hex (#RRGGBB).</small>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Secondary color</label>
                    <input type="text" name="secondary_color" class="form-control" placeholder="#F2A11F" value="{{ old('secondary_color', $settings->secondary_color) }}">
                    <small class="text-muted">Hex (#RRGGBB).</small>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Google Play link</label>
                    <input type="url" name="google_play_url" class="form-control" placeholder="https://play.google.com/store/apps/details?id=..." value="{{ old('google_play_url', $settings->google_play_url) }}">
                    <small class="text-muted">Shows a "Get it on Google Play" badge in the website footer. Leave empty to hide it.</small>
                </div>

                <div class="col-md-6">
                    <label class="form-label">App APK (direct download)</label>
                    <input type="file" name="apk" class="form-control" accept=".apk,application/vnd.android.package-archive">
                    <small class="text-muted">Fallback download until the app is live on Google Play. Used only when no Google Play link is set. Max 100&nbsp;MB.</small>
                    @if ($settings->apk)
                        <div class="mt-2 d-flex align-items-center gap-2">
                            <a href="{{ $settings->apk_url }}" class="btn btn-sm btn-outline-secondary" download>
                                <i class="bi bi-android2"></i> Download current APK
                            </a>
                            <form action="{{ route('admin.settings.apk.clear') }}" method="POST" onsubmit="return confirm('Remove current APK?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Remove</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">Save settings</button>
            </div>
        </form>
    </div>
</div>
@endsection
