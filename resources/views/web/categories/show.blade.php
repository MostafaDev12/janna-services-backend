@extends('web.layouts.app')
@section('title', $category->localized('name').' | '.config('app.name'))

@section('content')
<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home_breadcrumb') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('web.categories.index') }}">{{ __('messages.categories') }}</a></li>
            <li class="breadcrumb-item active">{{ $category->localized('name') }}</li>
        </ol>
    </nav>
    <h3>{{ $category->localized('name') }}</h3>
    @if ($category->localized('description'))
        <p class="text-muted">{{ $category->localized('description') }}</p>
    @endif

    <div class="row g-3 mt-2">
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
