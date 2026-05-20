@extends('web.layouts.app')
@section('title', __('messages.important_numbers').' | '.config('app.name'))

@section('content')
<div class="container my-5">
    <h3 class="mb-4">{{ __('messages.important_numbers') }}</h3>
    <div class="row g-3">
        @forelse ($numbers as $n)
            <div class="col-md-6 col-lg-4">
                <div class="card number-card p-3 h-100">
                    <div class="fw-semibold">{{ $n->localized('title') }}</div>
                    @if ($n->localized('description'))
                        <div class="text-muted small mb-2">{{ $n->localized('description') }}</div>
                    @endif
                    <div class="d-flex gap-2 mt-auto">
                        <a href="tel:{{ $n->phone }}" class="btn btn-sm btn-success"><i class="bi bi-telephone-fill"></i> {{ $n->phone }}</a>
                        @if ($n->whatsapp)
                            <a href="https://wa.me/{{ preg_replace('/\D+/', '', $n->whatsapp) }}" target="_blank" class="btn btn-sm btn-outline-success"><i class="bi bi-whatsapp"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">{{ __('messages.no_numbers_yet') }}</p>
        @endforelse
    </div>
</div>
@endsection
