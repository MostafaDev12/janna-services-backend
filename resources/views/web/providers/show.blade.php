@extends('web.layouts.app')
@section('title', $provider->localized('name').' | '.config('app.name'))

@php
    $gallery = $provider->media->where('type', 'gallery');
    $menu    = $provider->media->where('type', 'menu');
    $products= $provider->media->where('type', 'product');
    $areaLabel = $provider->area_type === 'inside_compound'
        ? __('messages.inside_compound')
        : __('messages.near_compound');
@endphp

@section('content')
<div class="container my-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home_breadcrumb') }}</a></li>
            @if ($provider->category)
                <li class="breadcrumb-item"><a href="{{ route('web.categories.show', $provider->category->slug) }}">{{ $provider->category->localized('name') }}</a></li>
            @endif
            <li class="breadcrumb-item active">{{ $provider->localized('name') }}</li>
        </ol>
    </nav>

    <div class="card border-0 shadow-sm overflow-hidden mb-4">
        @if ($provider->cover_image_url)
            <img src="{{ $provider->cover_image_url }}" class="w-100" style="max-height:320px;object-fit:cover">
        @else
            <div class="bg-light" style="height:200px"></div>
        @endif
        <div class="card-body">
            <div class="d-flex align-items-end gap-3 flex-wrap" style="margin-top: -56px">
                @if ($provider->logo_url)
                    <img src="{{ $provider->logo_url }}" style="width:96px;height:96px;border-radius:14px;object-fit:cover;border:4px solid #fff;background:#fff;box-shadow:0 2px 8px rgba(0,0,0,.1)">
                @endif
                <div class="flex-grow-1">
                    <div class="d-flex flex-wrap gap-2 align-items-center">
                        <h3 class="m-0">{{ $provider->localized('name') }}</h3>
                        @if ($provider->is_featured)<span class="badge bg-warning text-dark"><i class="bi bi-star-fill"></i> {{ __('messages.featured') }}</span>@endif
                    </div>
                    <div class="text-muted">{{ $provider->category?->localized('name') }} · <span class="badge badge-area">{{ $areaLabel }}</span></div>
                </div>
            </div>

            <div class="mt-3 d-flex flex-wrap gap-2">
                @if ($provider->phone)
                    <a href="tel:{{ $provider->phone }}" class="btn btn-success"><i class="bi bi-telephone-fill"></i> {{ __('messages.call') }}</a>
                @endif
                @if ($provider->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/\D+/', '', $provider->whatsapp) }}" target="_blank" class="btn btn-outline-success"><i class="bi bi-whatsapp"></i> {{ __('messages.whatsapp') }}</a>
                @endif
                @if ($provider->location_url)
                    <a href="{{ $provider->location_url }}" target="_blank" class="btn btn-outline-primary"><i class="bi bi-geo-alt-fill"></i> {{ __('messages.location') }}</a>
                @endif
            </div>

            <hr>

            <div class="row">
                <div class="col-md-8">
                    @if ($provider->localized('description'))
                        <h6>{{ __('messages.about') }}</h6>
                        <p>{!! nl2br(e($provider->localized('description'))) !!}</p>
                    @endif
                </div>
                <div class="col-md-4">
                    <ul class="list-unstyled small">
                        @if ($provider->localized('address'))
                            <li class="mb-2"><i class="bi bi-geo-alt text-primary"></i> {{ $provider->localized('address') }}</li>
                        @endif
                        @if ($provider->localized('working_hours'))
                            <li class="mb-2"><i class="bi bi-clock text-primary"></i> {{ $provider->localized('working_hours') }}</li>
                        @endif
                        @if ($provider->phone)
                            <li class="mb-2"><i class="bi bi-telephone text-primary"></i> {{ $provider->phone }}</li>
                        @endif
                        @if ($provider->whatsapp)
                            <li class="mb-2"><i class="bi bi-whatsapp text-success"></i> {{ $provider->whatsapp }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @if ($gallery->isNotEmpty())
    <section class="mb-4">
        <h5 class="mb-3">{{ __('messages.gallery') }}</h5>
        <div class="row g-2">
            @foreach ($gallery as $g)
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ $g->image_url }}" target="_blank">
                        <img src="{{ $g->image_url }}" class="img-fluid rounded shadow-sm" style="aspect-ratio:1/1;object-fit:cover;width:100%">
                    </a>
                </div>
            @endforeach
        </div>
    </section>
    @endif

    @if ($menu->isNotEmpty())
    <section class="mb-4">
        <h5 class="mb-3">{{ __('messages.menu') }}</h5>
        <div class="row g-2">
            @foreach ($menu as $m)
                <div class="col-6 col-md-4">
                    <a href="{{ $m->image_url }}" target="_blank">
                        <img src="{{ $m->image_url }}" class="img-fluid rounded shadow-sm" alt="{{ $m->localized('title') }}">
                    </a>
                    @if ($m->localized('title'))<div class="small text-center text-muted mt-1">{{ $m->localized('title') }}</div>@endif
                </div>
            @endforeach
        </div>
    </section>
    @endif

    @if ($products->isNotEmpty())
    <section class="mb-4">
        <h5 class="mb-3">{{ __('messages.products') }}</h5>
        <div class="row g-2">
            @foreach ($products as $pr)
                <div class="col-6 col-md-4 col-lg-3">
                    <img src="{{ $pr->image_url }}" class="img-fluid rounded shadow-sm" alt="{{ $pr->localized('title') }}">
                    @if ($pr->localized('title'))<div class="small text-center text-muted mt-1">{{ $pr->localized('title') }}</div>@endif
                </div>
            @endforeach
        </div>
    </section>
    @endif

    @if ($related->isNotEmpty())
    <section class="mb-4">
        <h5 class="mb-3">{{ __('messages.related_providers') }}</h5>
        <div class="row g-3">
            @foreach ($related as $p)
                <div class="col-md-6 col-lg-3">
                    @include('web.partials.provider_card')
                </div>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection
