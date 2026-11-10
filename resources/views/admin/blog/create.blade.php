@extends('admin.layouts.app')
@section('title', 'Create Blog')
@section('subtitle', 'Create New Blog')

@section('content')
    <form action={{ route('admin.blog.store') }} method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label-custom">Category* :</label>
            <select name="blog_category_id" id="" class="form-control">
                @foreach ($categories as $category)
                    <option value={{ $category->id }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Blog Title* :</label>
            <input type="text" class="form-control" name="name" required value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Slug (Optional) :</label>
            <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
            @error('slug')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-6">
                    <label for="" class="form-label-custom">Cover Path</label>
                    <input type="file" name="cover_path">
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Brief Description (Optional) :</label>
            <input type="text" class="form-control" name="brief_description" value="{{ old('brief_description') }}">
            @error('brief_description')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Content :</label>
            <textarea name="content" cols="30" rows="10" class="d-none">{{ old('description') }}</textarea>
            <div id="editor">{!! old('content') !!}</div>
            @error('content')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Author :</label>
            <input type="text" class="form-control" name="author" value="{{ auth()->user()->name }}">
            @error('author')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn-custom btn-custom-primary">Save</button>
            <a href="{{ url()->previous() }}" class="btn-custom btn-custom-warning">Back</a>
        </div>
    </form>
@endsection
