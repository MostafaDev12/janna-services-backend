@extends('admin.layouts.app')
@section('title', 'Edit Number')
@section('content')
<div class="card"><div class="card-body">
    <h5 class="mb-3">Edit: {{ $number->title }}</h5>
    <form action="{{ route('admin.important-numbers.update', $number) }}" method="POST">
        @method('PUT')
        @include('admin.important_numbers._form')
    </form>
</div></div>
@endsection
