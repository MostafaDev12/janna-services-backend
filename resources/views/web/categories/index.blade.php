@extends('web.layouts.app')
@section('title', __('messages.categories').' | '.config('app.name'))

@section('content')
<div class="container my-5">
    <h3 class="mb-4">{{ __('messages.all_categories') }}</h3>
    <div class="row g-3">
        @forelse ($categories as $c)
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('web.categories.show', $c->slug) }}" class="text-decoration-none text-dark">
                    <div class="card card-cat p-3 h-100">
                        <div class="d-flex align-items-center gap-3">
                            @if ($c->image_url)
                                <img src="{{ $c->image_url }}" class="rounded" style="width:56px;height:56px;object-fit:cover">
                            @else
                                <div class="icon-wrap"><i class="bi bi-grid"></i></div>
                            @endif
                            <div>
                                <div class="fw-semibold">{{ $c->localized('name') }}</div>
                                <div class="small text-muted">{{ $c->providers_count }} {{ __('messages.providers') }}</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <p class="text-muted">{{ __('messages.no_categories_yet') }}</p>
        @endforelse
    </div>
</div>
@endsection
