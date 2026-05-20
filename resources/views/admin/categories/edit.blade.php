@extends('admin.layouts.app')
@section('title', 'Edit Category')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="mb-3">Edit Category: {{ $category->name }}</h5>
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.categories._form')
        </form>
    </div>
</div>
@endsection
