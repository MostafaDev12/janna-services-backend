@extends('web.layouts.app')

@section('content')
<section class="hero">
    <div class="container">
        <h1>{{ __('messages.hero_title') }}</h1>
        <p class="lead opacity-75 mb-3">{{ __('messages.hero_subtitle') }}</p>
        <form class="row g-2 mt-3" action="{{ route('web.search') }}" method="GET">
            <div class="col-md-8">
                <input class="form-control form-control-lg" name="keyword" placeholder="{{ __('messages.search_placeholder') }}" value="{{ request('keyword') }}">
            </div>
            <div class="col-md-4 d-grid">
                <button class="btn btn-light btn-lg"><i class="bi bi-search"></i> {{ __('messages.search') }}</button>
            </div>
        </form>
    </div>
</section>

@if ($banners->isNotEmpty())
<section class="container my-3 my-md-4">
    <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner rounded-3 shadow-sm">
            @foreach ($banners as $i => $b)
                <div class="carousel-item @if($i===0) active @endif">
                    @if ($b->link_url || $b->provider)
                        <a href="{{ $b->link_url ?: route('web.providers.show', $b->provider->slug) }}">
                            <img src="{{ $b->image_url }}" class="banner-img" alt="{{ $b->localized('title') }}">
                        </a>
                    @else
                        <img src="{{ $b->image_url }}" class="banner-img" alt="{{ $b->localized('title') }}">
                    @endif
                </div>
            @endforeach
        </div>
        @if ($banners->count() > 1)
            <button class="carousel-control-prev" data-bs-target="#bannerCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
            <button class="carousel-control-next" data-bs-target="#bannerCarousel" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
        @endif
    </div>
</section>
@endif

<section class="container my-4 my-md-5">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h4 class="mb-0 h5-mobile">{{ __('messages.browse_categories') }}</h4>
        <a href="{{ route('web.categories.index') }}" class="btn btn-link p-0">{{ __('messages.all_categories') }} →</a>
    </div>
    <div class="row g-2 g-md-3">
        @forelse ($categories as $c)
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('web.categories.show', $c->slug) }}" class="text-decoration-none text-dark">
                    <div class="card card-cat p-3 h-100">
                        <div class="d-flex align-items-center gap-2 gap-md-3">
                            @if ($c->image_url)
                                <img src="{{ $c->image_url }}" class="rounded icon-wrap" alt="" style="object-fit:cover;padding:0">
                            @else
                                <div class="icon-wrap"><i class="bi bi-grid"></i></div>
                            @endif
                            <div class="card-cat-body">
                                <div class="name">{{ $c->localized('name') }}</div>
                                @if ($c->localized('description'))
                                    <div class="desc">{{ $c->localized('description') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <p class="text-muted">{{ __('messages.no_categories_yet') }}</p>
        @endforelse
    </div>
</section>

@if ($featured->isNotEmpty())
<section class="container my-4 my-md-5">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h4 class="mb-0 h5-mobile">{{ __('messages.featured_providers') }}</h4>
        <a href="{{ route('web.providers.index', ['featured' => 1]) }}" class="btn btn-link p-0">{{ __('messages.view_all') }} →</a>
    </div>
    <div class="row g-3">
        @foreach ($featured as $p)
            <div class="col-sm-6 col-lg-3">
                @include('web.partials.provider_card')
            </div>
        @endforeach
    </div>
</section>
@endif

@if ($importantNumbers->isNotEmpty())
<section class="container my-4 my-md-5">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h4 class="mb-0 h5-mobile">{{ __('messages.important_numbers') }}</h4>
        <a href="{{ route('web.important-numbers') }}" class="btn btn-link p-0">{{ __('messages.view_all') }} →</a>
    </div>
    <div class="row g-2 g-md-3">
        @foreach ($importantNumbers as $n)
            <div class="col-sm-6 col-lg-4">
                <div class="card number-card p-3">
                    <div class="d-flex justify-content-between align-items-start gap-2">
                        <div class="flex-grow-1" style="min-width:0">
                            <div class="fw-semibold text-truncate">{{ $n->localized('title') }}</div>
                            <div class="text-muted small text-truncate">{{ $n->localized('description') }}</div>
                        </div>
                        <a href="tel:{{ $n->phone }}" class="btn btn-sm btn-success flex-shrink-0"><i class="bi bi-telephone"></i> <span class="d-none d-sm-inline">{{ $n->phone }}</span></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endif
@endsection
