@extends('admin.layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="row g-3 mb-4">
    @php $cards = [
        ['label' => 'Categories', 'value' => $stats['categories'], 'icon' => 'tags', 'color' => 'primary'],
        ['label' => 'Providers', 'value' => $stats['providers'], 'icon' => 'shop', 'color' => 'success'],
        ['label' => 'Featured', 'value' => $stats['featured_providers'], 'icon' => 'star-fill', 'color' => 'warning'],
        ['label' => 'Media', 'value' => $stats['media'], 'icon' => 'images', 'color' => 'info'],
        ['label' => 'Important Numbers', 'value' => $stats['important_numbers'], 'icon' => 'telephone', 'color' => 'danger'],
        ['label' => 'Banners', 'value' => $stats['banners'], 'icon' => 'image', 'color' => 'dark'],
    ]; @endphp
    @foreach ($cards as $c)
        <div class="col-md-4 col-lg-2">
            <div class="card card-stat p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">{{ $c['label'] }}</div>
                        <div class="num">{{ $c['value'] }}</div>
                    </div>
                    <i class="bi bi-{{ $c['icon'] }} fs-2 text-{{ $c['color'] }}"></i>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="card">
    <div class="card-header bg-white"><strong>Latest Providers</strong></div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead><tr><th>Name</th><th>Category</th><th>Area</th><th>Status</th><th></th></tr></thead>
            <tbody>
                @forelse ($latestProviders as $p)
                    <tr>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->category?->name }}</td>
                        <td><span class="badge bg-light text-dark">{{ str_replace('_', ' ', $p->area_type) }}</span></td>
                        <td>@if ($p->is_active) <span class="badge bg-success">Active</span> @else <span class="badge bg-secondary">Inactive</span> @endif</td>
                        <td class="text-end"><a href="{{ route('admin.providers.edit', $p) }}" class="btn btn-sm btn-outline-primary">Edit</a></td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">No providers yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
