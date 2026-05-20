@extends('web.layouts.app')
@section('title', __('messages.providers').' | '.config('app.name'))

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">{{ __('messages.providers') }}</h3>
        <small class="text-muted">{{ $providers->total() }}</small>
    </div>

    <form class="card card-body mb-4 border-0 shadow-sm" method="GET">
        <div class="row g-2">
            <div class="col-md-4">
                <input class="form-control" name="keyword" value="{{ request('keyword') }}" placeholder="{{ __('messages.search') }}...">
            </div>
            <div class="col-md-3">
                <select name="category" class="form-select">
                    <option value="">{{ __('messages.all_categories') }}</option>
                    @foreach ($categories as $c)
                        <option value="{{ $c->slug }}" @selected(request('category') === $c->slug)>{{ $c->localized('name') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="area_type" class="form-select">
                    <option value="">{{ __('messages.all_categories') }}</option>
                    <option value="inside_compound" @selected(request('area_type') === 'inside_compound')>{{ __('messages.inside_compound') }}</option>
                    <option value="near_compound" @selected(request('area_type') === 'near_compound')>{{ __('messages.near_compound') }}</option>
                </select>
            </div>
            <div class="col-md-2 d-grid">
                <button class="btn btn-primary">{{ __('messages.filter') }}</button>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input type="hidden" name="featured" value="0">
                    <input type="checkbox" name="featured" value="1" id="featured" class="form-check-input" {{ request('featured') ? 'checked' : '' }}>
                    <label for="featured" class="form-check-label small">{{ __('messages.featured') }}</label>
                </div>
            </div>
        </div>
    </form>

    <div class="row g-3">
        @forelse ($providers as $p)
            <div class="col-md-6 col-lg-4">
                @include('web.partials.provider_card')
            </div>
        @empty
            <p class="text-muted">{{ __('messages.no_providers') }}</p>
        @endforelse
    </div>

    <div class="mt-4">{{ $providers->links() }}</div>
</div>
@endsection
