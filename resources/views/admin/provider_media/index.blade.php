@extends('admin.layouts.app')
@section('title', 'Provider Media')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="m-0">Media — {{ $provider->name_en ?? $provider->name }}</h4>
        <a href="{{ route('admin.providers.edit', $provider) }}" class="small text-decoration-none"><i class="bi bi-arrow-left"></i> Back to provider</a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-white"><strong>Upload media</strong></div>
    <div class="card-body">
        <form action="{{ route('admin.providers.media.store', $provider) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Type *</label>
                    <select name="type" class="form-select" required>
                        @foreach (\App\Models\ProviderMedia::TYPES as $t)
                            <option value="{{ $t }}">{{ ucfirst($t) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Title (English)</label>
                    <input type="text" name="title_en" class="form-control" placeholder="Optional caption">
                </div>
                <div class="col-md-3">
                    <label class="form-label">العنوان (بالعربية)</label>
                    <input type="text" name="title_ar" class="form-control" dir="rtl" placeholder="عنوان اختياري">
                </div>
                <div class="col-md-1">
                    <label class="form-label">Sort</label>
                    <input type="number" name="sort_order" value="0" min="0" class="form-control">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <div class="form-check">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" id="m_active" checked class="form-check-input">
                        <label for="m_active" class="form-check-label">Active</label>
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label">Image(s) *</label>
                    <input type="file" name="image[]" class="form-control" accept="image/*" multiple required>
                    <small class="text-muted">You can select multiple images at once.</small>
                </div>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary"><i class="bi bi-upload"></i> Upload</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white"><strong>Existing media ({{ $provider->media->count() }})</strong></div>
    <div class="card-body">
        @if ($provider->media->isEmpty())
            <p class="text-muted m-0">No media uploaded yet.</p>
        @else
            <div class="row g-3">
                @foreach ($provider->media as $m)
                    <div class="col-md-4 col-lg-3">
                        <div class="card h-100">
                            <img src="{{ $m->image_url }}" class="card-img-top" style="height:160px;object-fit:cover">
                            <div class="card-body p-2">
                                <form action="{{ route('admin.providers.media.update', [$provider, $m]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-info text-dark">{{ $m->type }}</span>
                                        @if ($m->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </div>
                                    <select name="type" class="form-select form-select-sm mb-2">
                                        @foreach (\App\Models\ProviderMedia::TYPES as $t)
                                            <option value="{{ $t }}" @selected($m->type === $t)>{{ ucfirst($t) }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" name="title_en" value="{{ $m->title_en ?? $m->title }}" class="form-control form-control-sm mb-2" placeholder="Title (EN)">
                                    <input type="text" name="title_ar" value="{{ $m->title_ar }}" class="form-control form-control-sm mb-2" dir="rtl" placeholder="العنوان">
                                    <input type="number" name="sort_order" value="{{ $m->sort_order }}" min="0" class="form-control form-control-sm mb-2" placeholder="Sort">
                                    <div class="form-check mb-2">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" name="is_active" value="1" id="m_a_{{ $m->id }}" class="form-check-input" {{ $m->is_active ? 'checked' : '' }}>
                                        <label for="m_a_{{ $m->id }}" class="form-check-label small">Active</label>
                                    </div>
                                    <input type="file" name="image" class="form-control form-control-sm mb-2" accept="image/*">
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-primary flex-grow-1">Save</button>
                                </form>
                                <form action="{{ route('admin.providers.media.destroy', [$provider, $m]) }}" method="POST" onsubmit="return confirm('Delete this image?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                                    </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
