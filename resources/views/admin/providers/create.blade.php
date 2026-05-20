@extends('admin.layouts.app')
@section('title', 'New Provider')

@section('content')
<div class="card"><div class="card-body">
    <h5 class="mb-3">New Provider</h5>
    <form action="{{ route('admin.providers.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.providers._form')
    </form>
</div></div>
@endsection
