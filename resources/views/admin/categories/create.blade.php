@extends('admin.layouts.app')
@section('title', 'New Category')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="mb-3">New Category</h5>
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @include('admin.categories._form')
        </form>
    </div>
</div>
@endsection
