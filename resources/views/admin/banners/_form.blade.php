@csrf
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Title (English)</label>
        <input type="text" name="title_en" class="form-control" value="{{ old('title_en', $banner->title_en ?? $banner->title) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">العنوان (بالعربية)</label>
        <input type="text" name="title_ar" class="form-control" dir="rtl" value="{{ old('title_ar', $banner->title_ar) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Subtitle (English)</label>
        <input type="text" name="subtitle_en" class="form-control" value="{{ old('subtitle_en', $banner->subtitle_en ?? $banner->subtitle) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">العنوان الفرعي (بالعربية)</label>
        <input type="text" name="subtitle_ar" class="form-control" dir="rtl" value="{{ old('subtitle_ar', $banner->subtitle_ar) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Linked provider</label>
        <select name="provider_id" class="form-select">
            <option value="">— none —</option>
            @foreach ($providers as $p)
                <option value="{{ $p->id }}" @selected(old('provider_id', $banner->provider_id) == $p->id)>{{ $p->name_en ?? $p->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">External link URL</label>
        <input type="url" name="link_url" class="form-control" value="{{ old('link_url', $banner->link_url) }}" placeholder="https://...">
    </div>
    <div class="col-12">
        <label class="form-label">Image {{ $banner->exists ? '' : '*' }}</label>
        <input type="file" name="image" class="form-control" accept="image/*" {{ $banner->exists ? '' : 'required' }}>
        @if ($banner->image)
            <img src="{{ $banner->image_url }}" class="img-preview mt-2" style="max-height:160px">
        @endif
    </div>
    <div class="col-md-3">
        <label class="form-label">Sort order</label>
        <input type="number" name="sort_order" min="0" class="form-control" value="{{ old('sort_order', $banner->sort_order ?? 0) }}">
    </div>
    <div class="col-md-3 d-flex align-items-end">
        <div class="form-check">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" id="is_active" class="form-check-input" {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
            <label for="is_active" class="form-check-label">Active</label>
        </div>
    </div>
</div>
<div class="mt-4">
    <button class="btn btn-primary">Save</button>
    <a href="{{ route('admin.banners.index') }}" class="btn btn-link">Cancel</a>
</div>
