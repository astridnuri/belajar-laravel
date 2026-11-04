@extends('admin.layouts.app')
@section('title', 'Product Management')
@section('subtitle', 'Product List')
@section('content')
    <div align="right">
        <a href="{{ route('admin.product.create') }}" class="btn-table-action">
            <i class="bi bi-plus-circle-fill"></i> Add Product
        </a>
    </div>
    <table class="table-custom">
        <thead>
            <tr>
                <th>No</th>
                <th>Image</th>
                <th>Category</th>
                <th>Product Name</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- @dd($products)  utk ngecek ud masuk blm datanya--}}
            @foreach ($products as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if ($item->image !== null)
                    <img src="{{ asset('storage/'.$item->image) }}" width="100" alt="{{ $item->name??'' }}">
                    @else
                    <span class="text-muted">Image Unavailable</span>
                    @endif
                </td>
                <td>{{ $item->category->name ?? '-----' }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->stock }}</td>
                <td>Rp {{ number_format($item->price,2,',','.') }}</td>
                <td>
                    <a class="table-btn-action" title="Edit" href="{{ route('admin.product.edit',$item->id) }}">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.product.destroy', $item->id) }}" method="post" class="d-inline" onsubmit="return confirm('Do you want to delete this data?')">
                            @csrf
                            @method('DELETE')
                            <button class="table-btn-action delete" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
