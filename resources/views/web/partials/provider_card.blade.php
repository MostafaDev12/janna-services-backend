@php
    $areaLabel = $p->area_type === 'inside_compound'
        ? __('messages.inside_compound')
        : __('messages.near_compound');
@endphp
<div class="card card-provider h-100 shadow-sm border-0">
    @if ($p->cover_image_url)
        <img src="{{ $p->cover_image_url }}" class="cover" alt="{{ $p->localized('name') }}">
    @else
        <div class="cover bg-light d-flex align-items-center justify-content-center text-muted"><i class="bi bi-image fs-1"></i></div>
    @endif
    <div class="card-body">
        @if ($p->logo_url)
            <img src="{{ $p->logo_url }}" class="logo mb-2">
        @endif
        <div class="d-flex justify-content-between align-items-start">
            <h6 class="card-title mb-1">{{ $p->localized('name') }}</h6>
            @if ($p->is_featured) <i class="bi bi-star-fill text-warning small" title="{{ __('messages.featured') }}"></i> @endif
        </div>
        <div class="small text-muted mb-2">{{ $p->category?->localized('name') }}</div>
        @if ($p->localized('short_description'))
            <p class="small mb-2 text-truncate" style="max-width: 100%">{{ $p->localized('short_description') }}</p>
        @endif
        <span class="badge badge-area small">{{ $areaLabel }}</span>
    </div>
    <div class="card-footer bg-white border-0 pt-0">
        <a href="{{ route('web.providers.show', $p->slug) }}" class="btn btn-sm btn-outline-primary w-100">{{ __('messages.view_details') }}</a>
    </div>
</div>
