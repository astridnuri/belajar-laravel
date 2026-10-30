@extends('admin.layouts.app')
@section('title','Create Category')
@section('subtitle', 'Create New Category')

@section('content')
    <form action={{ route('admin.category.store') }} method="POST">
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
            <label for="" class="form-label-custom">Icon :</label>
            <input type="text" class="form-control" name="icon" value="{{ old('icon') }}">
            @error('icon')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Sort Order :</label>
            <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order') }}">
            @error('sort_order')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn-custom btn-custom-primary">Save</button>
            <a href="{{ url()->previous() }}" class="btn-custom btn-custom-warning">Back<
        </div>
    </form>
@endsection
