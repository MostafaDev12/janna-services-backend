@extends('admin.layouts.app')
@section('title', 'New Number')
@section('content')
<div class="card"><div class="card-body">
    <h5 class="mb-3">New Important Number</h5>
    <form action="{{ route('admin.important-numbers.store') }}" method="POST">
        @include('admin.important_numbers._form')
    </form>
</div></div>
@endsection
