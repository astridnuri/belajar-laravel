@extends('admin.layouts.app')
@section('title','Create Blog Category')
@section('subtitle', 'Create New Blog Category')

@section('content')
    <form action={{ route('admin.category_blog.store') }} method="POST">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label-custom">Category Name :</label>
            <input type="text" class="form-control" name="name" required value="{{ old('name') }}">
            @error('name')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Slug (optional) :</label>
            <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
            @error('slug')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn-custom btn-custom-primary">Save</button>
            <a href="{{ url()->previous() }}" class="btn-custom btn-custom-warning">Back<
        </div>
    </form>
@endsection
