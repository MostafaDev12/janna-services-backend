@extends('admin.layouts.app')
@section('title', 'Message')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back to inbox</a>
    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Delete this message?')">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Delete</button>
    </form>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="mb-1">{{ $message->title }}</h5>
        <div class="text-muted small mb-3">
            {{ $message->created_at->format('M j, Y g:i A') }}
            @if ($message->name) · <strong>{{ $message->name }}</strong>@endif
        </div>

        @if ($message->contact)
            <p class="mb-3">
                <span class="text-muted">Reply to:</span>
                @php $c = $message->contact; @endphp
                @if (filter_var($c, FILTER_VALIDATE_EMAIL))
                    <a href="mailto:{{ $c }}">{{ $c }}</a>
                @elseif (preg_match('/^[+0-9 ()-]{6,}$/', $c))
                    <a href="tel:{{ preg_replace('/[^+0-9]/', '', $c) }}">{{ $c }}</a>
                @else
                    {{ $c }}
                @endif
            </p>
        @endif

        <div class="border rounded p-3 bg-light" style="white-space: pre-wrap">{{ $message->body }}</div>
    </div>
</div>
@endsection
