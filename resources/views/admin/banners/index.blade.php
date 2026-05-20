@extends('admin.layouts.app')
@section('title', 'Banners')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="m-0">Banners</h4>
    <a href="{{ route('admin.banners.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> New Banner</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead><tr><th>Image</th><th>Title</th><th>Provider</th><th>Link</th><th>Sort</th><th>Status</th><th></th></tr></thead>
            <tbody>
            @forelse ($banners as $b)
                <tr>
                    <td><img src="{{ $b->image_url }}" class="img-preview" style="height:50px"></td>
                    <td>
                        <div class="fw-semibold">{{ $b->title ?: '—' }}</div>
                        <div class="small text-muted">{{ $b->subtitle }}</div>
                    </td>
                    <td>{{ $b->provider?->name ?? '—' }}</td>
                    <td>@if ($b->link_url)<a href="{{ $b->link_url }}" target="_blank" class="small">link</a>@else <span class="text-muted">—</span>@endif</td>
                    <td>{{ $b->sort_order }}</td>
                    <td>@if ($b->is_active)<span class="badge bg-success">Active</span>@else<span class="badge bg-secondary">Inactive</span>@endif</td>
                    <td class="text-end">
                        <a href="{{ route('admin.banners.edit', $b) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('admin.banners.destroy', $b) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted py-4">No banners yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $banners->links() }}</div>
@endsection
