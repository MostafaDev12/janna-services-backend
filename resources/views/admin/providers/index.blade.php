@extends('admin.layouts.app')
@section('title', 'Service Providers')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="m-0">Service Providers</h4>
    <a href="{{ route('admin.providers.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> New Provider</a>
</div>

<form class="card card-body mb-3" method="GET">
    <div class="row g-2">
        <div class="col-md-5">
            <input name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Search name / phone / address">
        </div>
        <div class="col-md-4">
            <select name="category" class="form-select">
                <option value="">All categories</option>
                @foreach ($categories as $c)
                    <option value="{{ $c->id }}" @selected(request('category') == $c->id)>{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 d-grid">
            <button class="btn btn-outline-primary">Filter</button>
        </div>
    </div>
</form>

<div class="card">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Area</th>
                    <th>Phone</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @forelse ($providers as $p)
                <tr>
                    <td>
                        @if ($p->logo)
                            <img src="{{ $p->logo_url }}" class="img-preview" style="height:40px;width:40px;object-fit:cover;border-radius:50%">
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>
                        <div class="fw-semibold">{{ $p->name }}</div>
                        <div class="small text-muted">{{ $p->slug }}</div>
                    </td>
                    <td>{{ $p->category?->name }}</td>
                    <td><span class="badge bg-light text-dark">{{ str_replace('_', ' ', $p->area_type) }}</span></td>
                    <td>{{ $p->phone }}</td>
                    <td>@if ($p->is_featured) <i class="bi bi-star-fill text-warning"></i> @endif</td>
                    <td>
                        @if ($p->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.providers.media.index', $p) }}" class="btn btn-sm btn-outline-info"><i class="bi bi-images"></i> Media</a>
                        <a href="{{ route('admin.providers.edit', $p) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('admin.providers.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this provider and all its media?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center text-muted py-4">No providers yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $providers->links() }}</div>
@endsection
