@csrf
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Name (English) *</label>
        <input type="text" name="name_en" class="form-control" value="{{ old('name_en', $category->name_en ?? $category->name) }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">الاسم (بالعربية)</label>
        <input type="text" name="name_ar" class="form-control" dir="rtl" value="{{ old('name_ar', $category->name_ar) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Slug <span class="text-muted small">(leave empty to auto-generate)</span></label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug', $category->slug) }}">
    </div>
    <div class="col-12">
        <label class="form-label">Description (English)</label>
        <textarea name="description_en" rows="3" class="form-control">{{ old('description_en', $category->description_en ?? $category->description) }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label">الوصف (بالعربية)</label>
        <textarea name="description_ar" rows="3" class="form-control" dir="rtl">{{ old('description_ar', $category->description_ar) }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">Icon</label>
        <input type="file" name="icon" class="form-control" accept="image/*">
        @if ($category->icon)
            <img src="{{ $category->icon_url }}" class="img-preview mt-2" style="height:60px">
        @endif
    </div>
    <div class="col-md-6">
        <label class="form-label">Image</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        @if ($category->image)
            <img src="{{ $category->image_url }}" class="img-preview mt-2">
        @endif
    </div>
    <div class="col-md-4">
        <label class="form-label">Sort order</label>
        <input type="number" name="sort_order" min="0" class="form-control" value="{{ old('sort_order', $category->sort_order ?? 0) }}">
    </div>
    <div class="col-md-4 d-flex align-items-end">
        <div class="form-check">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" id="is_active" class="form-check-input" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
            <label for="is_active" class="form-check-label">Active</label>
        </div>
    </div>
</div>
<div class="mt-4">
    <button class="btn btn-primary">Save</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-link">Cancel</a>
</div>
