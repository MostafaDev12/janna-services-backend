@extends('admin.layouts.app')
@section('title', 'Important Numbers')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="m-0">Important Numbers</h4>
    <a href="{{ route('admin.important-numbers.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> New Number</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead><tr><th>Title</th><th>Phone</th><th>WhatsApp</th><th>Sort</th><th>Status</th><th></th></tr></thead>
            <tbody>
            @forelse ($numbers as $n)
                <tr>
                    <td>{{ $n->title }}</td>
                    <td>{{ $n->phone }}</td>
                    <td>{{ $n->whatsapp }}</td>
                    <td>{{ $n->sort_order }}</td>
                    <td>@if ($n->is_active)<span class="badge bg-success">Active</span>@else<span class="badge bg-secondary">Inactive</span>@endif</td>
                    <td class="text-end">
                        <a href="{{ route('admin.important-numbers.edit', $n) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('admin.important-numbers.destroy', $n) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-4">No numbers yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $numbers->links() }}</div>
@endsection
