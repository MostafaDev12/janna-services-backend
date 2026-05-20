@extends('admin.layouts.app')
@section('title', 'Edit Provider')

@section('content')
<div class="card"><div class="card-body">
    <h5 class="mb-3">Edit Provider: {{ $provider->name }}</h5>
    <form action="{{ route('admin.providers.update', $provider) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.providers._form')
    </form>
</div></div>
@endsection
