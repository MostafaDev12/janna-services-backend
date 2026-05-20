@extends('admin.layouts.app')
@section('title', 'Edit Banner')
@section('content')
<div class="card"><div class="card-body">
    <h5 class="mb-3">Edit Banner</h5>
    <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.banners._form')
    </form>
</div></div>
@endsection
