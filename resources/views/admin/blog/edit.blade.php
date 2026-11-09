@extends('admin.layouts.app')
@section('title','Edit Blog')
@section('subtitle', 'Edit Blog')

@section('content')
    <form action={{ route('admin.blog.update', $blog->id) }} method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="" class="form-label-custom">Blog Name :</label>
            <input type="text" class="form-control" name="name" required value="{{ old('name', $blog->name) }}">
            @error('name')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Slug (optional) :</label>
            <input type="text" class="form-control" name="slug" value="{{ old('slug', $blog->slug) }}">
            @error('slug')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <button type="submit" class="btn-custom btn-custom-primary">Save</button>
            <a href="{{ url()->previous() }}" class="btn-custom btn-custom-warning">Back</a>
        </div>
    </form>
@endsection
