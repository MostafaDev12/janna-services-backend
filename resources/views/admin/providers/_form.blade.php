@csrf
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Name (English) *</label>
        <input type="text" name="name_en" class="form-control" value="{{ old('name_en', $provider->name_en ?? $provider->name) }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">الاسم (بالعربية)</label>
        <input type="text" name="name_ar" class="form-control" dir="rtl" value="{{ old('name_ar', $provider->name_ar) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug', $provider->slug) }}" placeholder="auto-generated if empty">
    </div>
    <div class="col-md-6">
        <label class="form-label">Category *</label>
        <select name="category_id" class="form-select" required>
            <option value="">— select —</option>
            @foreach ($categories as $c)
                <option value="{{ $c->id }}" @selected(old('category_id', $provider->category_id) == $c->id)>{{ $c->name_en ?? $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Area type *</label>
        <select name="area_type" class="form-select" required>
            <option value="inside_compound" @selected(old('area_type', $provider->area_type) === 'inside_compound')>Inside compound</option>
            <option value="near_compound" @selected(old('area_type', $provider->area_type) === 'near_compound')>Near compound</option>
        </select>
    </div>
    <div class="col-12">
        <label class="form-label">Short description (English)</label>
        <input type="text" name="short_description_en" class="form-control" maxlength="500" value="{{ old('short_description_en', $provider->short_description_en ?? $provider->short_description) }}">
    </div>
    <div class="col-12">
        <label class="form-label">وصف مختصر (بالعربية)</label>
        <input type="text" name="short_description_ar" class="form-control" maxlength="500" dir="rtl" value="{{ old('short_description_ar', $provider->short_description_ar) }}">
    </div>
    <div class="col-12">
        <label class="form-label">Description (English)</label>
        <textarea name="description_en" rows="4" class="form-control">{{ old('description_en', $provider->description_en ?? $provider->description) }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label">الوصف (بالعربية)</label>
        <textarea name="description_ar" rows="4" class="form-control" dir="rtl">{{ old('description_ar', $provider->description_ar) }}</textarea>
    </div>
    <div class="col-md-4">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', $provider->phone) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">WhatsApp</label>
        <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp', $provider->whatsapp) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Working hours (English)</label>
        <input type="text" name="working_hours_en" class="form-control" value="{{ old('working_hours_en', $provider->working_hours_en ?? $provider->working_hours) }}" placeholder="e.g. 9:00 AM - 11:00 PM">
    </div>
    <div class="col-md-6">
        <label class="form-label">ساعات العمل (بالعربية)</label>
        <input type="text" name="working_hours_ar" class="form-control" dir="rtl" value="{{ old('working_hours_ar', $provider->working_hours_ar) }}" placeholder="مثال: من ٩ صباحاً حتى ١١ مساءً">
    </div>
    <div class="col-md-6">
        <label class="form-label">Address (English)</label>
        <input type="text" name="address_en" class="form-control" value="{{ old('address_en', $provider->address_en ?? $provider->address) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">العنوان (بالعربية)</label>
        <input type="text" name="address_ar" class="form-control" dir="rtl" value="{{ old('address_ar', $provider->address_ar) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Location URL (Google Maps)</label>
        <input type="url" name="location_url" class="form-control" value="{{ old('location_url', $provider->location_url) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Cover image</label>
        <input type="file" name="cover_image" class="form-control" accept="image/*">
        @if ($provider->cover_image)
            <img src="{{ $provider->cover_image_url }}" class="img-preview mt-2">
        @endif
    </div>
    <div class="col-md-6">
        <label class="form-label">Logo</label>
        <input type="file" name="logo" class="form-control" accept="image/*">
        @if ($provider->logo)
            <img src="{{ $provider->logo_url }}" class="img-preview mt-2" style="height:80px">
        @endif
    </div>
    <div class="col-md-3">
        <label class="form-label">Sort order</label>
        <input type="number" name="sort_order" min="0" class="form-control" value="{{ old('sort_order', $provider->sort_order ?? 0) }}">
    </div>
    <div class="col-md-3 d-flex align-items-end">
        <div class="form-check">
            <input type="hidden" name="is_featured" value="0">
            <input type="checkbox" name="is_featured" value="1" id="is_featured" class="form-check-input" {{ old('is_featured', $provider->is_featured) ? 'checked' : '' }}>
            <label for="is_featured" class="form-check-label">Featured</label>
        </div>
    </div>
    <div class="col-md-3 d-flex align-items-end">
        <div class="form-check">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" id="is_active" class="form-check-input" {{ old('is_active', $provider->is_active) ? 'checked' : '' }}>
            <label for="is_active" class="form-check-label">Active</label>
        </div>
    </div>
</div>

<div class="mt-4">
    <button class="btn btn-primary">Save</button>
    <a href="{{ route('admin.providers.index') }}" class="btn btn-link">Cancel</a>
    @if ($provider->exists)
        <a href="{{ route('admin.providers.media.index', $provider) }}" class="btn btn-outline-info float-end">
            <i class="bi bi-images"></i> Manage media
        </a>
    @endif
</div>
