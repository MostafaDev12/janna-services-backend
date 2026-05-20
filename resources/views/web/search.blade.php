@extends('web.layouts.app')
@section('title', __('messages.search').' | '.config('app.name'))

@section('content')
<div class="container my-5">
    <h3 class="mb-3">{{ __('messages.search') }}</h3>
    <form class="card card-body mb-4 border-0 shadow-sm" method="GET">
        <div class="row g-2">
            <div class="col-md-10">
                <input class="form-control form-control-lg" name="keyword" value="{{ $keyword }}" placeholder="{{ __('messages.search_placeholder') }}">
            </div>
            <div class="col-md-2 d-grid">
                <button class="btn btn-primary btn-lg"><i class="bi bi-search"></i></button>
            </div>
        </div>
    </form>

    @if ($keyword === '')
        <p class="text-muted">{{ __('messages.type_to_search') }}</p>
    @elseif ($providers->isEmpty())
        <p class="text-muted">{!! __('messages.no_results_for', ['keyword' => '<strong>'.e($keyword).'</strong>']) !!}</p>
    @else
        <p class="text-muted">{!! __('messages.results_count', ['count' => $providers->total(), 'keyword' => '<strong>'.e($keyword).'</strong>']) !!}</p>
        <div class="row g-3">
            @foreach ($providers as $p)
                <div class="col-md-6 col-lg-4">
                    @include('web.partials.provider_card')
                </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $providers->links() }}</div>
    @endif
</div>
@endsection
