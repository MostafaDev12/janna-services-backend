@csrf
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Title (English) *</label>
        <input type="text" name="title_en" class="form-control" value="{{ old('title_en', $number->title_en ?? $number->title) }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">العنوان (بالعربية)</label>
        <input type="text" name="title_ar" class="form-control" dir="rtl" value="{{ old('title_ar', $number->title_ar) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Phone *</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', $number->phone) }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">WhatsApp</label>
        <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp', $number->whatsapp) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">Sort order</label>
        <input type="number" name="sort_order" min="0" class="form-control" value="{{ old('sort_order', $number->sort_order ?? 0) }}">
    </div>
    <div class="col-md-3 d-flex align-items-end">
        <div class="form-check">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" id="is_active" class="form-check-input" {{ old('is_active', $number->is_active) ? 'checked' : '' }}>
            <label for="is_active" class="form-check-label">Active</label>
        </div>
    </div>
    <div class="col-12">
        <label class="form-label">Description (English)</label>
        <textarea name="description_en" rows="3" class="form-control">{{ old('description_en', $number->description_en ?? $number->description) }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label">الوصف (بالعربية)</label>
        <textarea name="description_ar" rows="3" class="form-control" dir="rtl">{{ old('description_ar', $number->description_ar) }}</textarea>
    </div>
</div>
<div class="mt-4">
    <button class="btn btn-primary">Save</button>
    <a href="{{ route('admin.important-numbers.index') }}" class="btn btn-link">Cancel</a>
</div>
