@extends('admin.layouts.app')
@section('title', 'Messages')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="m-0">Messages</h4>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead><tr><th>Subject</th><th>From</th><th>Received</th><th>Status</th><th></th></tr></thead>
            <tbody>
            @forelse ($messages as $m)
                <tr class="{{ $m->is_read ? '' : 'fw-semibold' }}">
                    <td>
                        <a href="{{ route('admin.messages.show', $m) }}" class="text-decoration-none">
                            @unless ($m->is_read)<i class="bi bi-circle-fill text-primary me-1" style="font-size:.5rem;vertical-align:middle"></i>@endunless
                            {{ \Illuminate\Support\Str::limit($m->title, 60) }}
                        </a>
                    </td>
                    <td>{{ $m->name ?: '—' }}<br><small class="text-muted">{{ $m->contact }}</small></td>
                    <td><small class="text-muted">{{ $m->created_at->diffForHumans() }}</small></td>
                    <td>
                        @if ($m->is_read)
                            <span class="badge bg-secondary">Read</span>
                        @else
                            <span class="badge bg-primary">New</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.messages.show', $m) }}" class="btn btn-sm btn-outline-primary">Open</a>
                        <form action="{{ route('admin.messages.destroy', $m) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this message?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted py-4">No messages yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $messages->links() }}</div>
@endsection
