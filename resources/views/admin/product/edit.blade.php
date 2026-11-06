@extends('admin.layouts.app')
@section('title', 'Add Product')
@section('subtitle', 'Add New Product to Display')

@section('content')
    <form action="{{ route('admin.product.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="">Product Name*</label>
            <input type="text" name="name" class="form-control" required value="{{ $product->name }}">
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="" class="form-label">Slug (optional)</label>
                    <input type="text" name="slug" class="form-control" value="{{ $product->slug }}">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="" class="form-label">Category</label>
                    <select name="category_id" class="form-select">
                        <option value="">Select Category</option>
                        @foreach ($categories as $c)
                            <option {{ $product->category_id === $c->id ? 'selected' : '' }} value="{{ $c->id }}">
                                {{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="">Brief Description</label>
            <input type="text" name="brief_description" class="form-control" value="{{ $product->brief_description }}">
        </div>
        <div class="mb-3">
            <label for="">Description</label>
            <textarea name="description" cols="30" rows="10" class="d-none form-control">{!! old('description') !!}</textarea>
            <div id="editor">{!! $product->description !!}</div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="">Price</label>
                    <input type="number" name="price" class="form-control" value="{{ $product->price }}">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="">Art Carton Price</label>
                    <input type="number" name="art_carton_price" class="form-control" value="{{ $product->brief_description }}">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="">Art Paper Price</label>
                    <input type="number" name="art_paper_price" class="form-control" value="{{ $product->art_paper_price }}">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="">HVS Price</label>
                    <input type="number" name="hvs_price" class="form-control" value="{{ $product->hvs_price }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="" class="form-label">Doff Laminating Price</label>
                    <input type="number" name="doff_price" class="form-control" value="{{ $product->doff_price }}">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="" class="form-label">Glossy Laminating Price</label>
                    <input type="number" name="glossy_price" class="form-control" value="{{ $product->glossy_price }}">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="mb-3">
                    <label for="" class="form-label">Cutting Price (Min 5x5 cm)</label>
                    <input type="number" name="cutting_price" class="form-control" value="{{ $product->cutting_price }}">
                </div>
            </div>
        </div>
        <div class="mb-3"></div>
        <label for="">Image</label>
        <input type="file" name="images[]" class="form-control">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn-custom btn-custom-primary">
                Save
            </button>
            <a href="{{ url()->previous() }}" class="btn-custom btn-custom-warning">Back</a>
        </div>
    </form>
@endsection
