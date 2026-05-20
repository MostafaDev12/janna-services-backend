@extends('admin.layouts.app')
@section('title', 'New Banner')
@section('content')
<div class="card"><div class="card-body">
    <h5 class="mb-3">New Banner</h5>
    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.banners._form')
    </form>
</div></div>
@endsection
