@extends('admin.layouts.app')
@section('title', 'Blog Management')
@section('subtitle', 'Manage Blog')

@section('content')
    <div class="mb-3" align="right">
        <a href={{ route('admin.category_blog.create') }} class="btn-table-action">
            <i class="bi bi-person-add"></i>Add Blog
        </a>
    </div>
    <div class="table-responsive">
        <table class="table-custom rounded-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cover</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Slug Url</th>
                    <th>Brief Desc</th>
                    <th>Author</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $categories as $key=>$data )
                <tr>
                    <td>{{ $key+=1 }}</td>
                    <td><img src="{{ asset('storage/'. $data->cover_path ??'') }}" alt=""></td>
                    <td>{{ $data->name??'' }}</td>
                    <td>{{ $data->category->name??'' }}</td>
                    <td>{{ $data->slug ??'' }}</td>
                    <td>{{ $data->brief_description ??'' }}</td>
                    <td>
                        <a class="table-btn-action" title="Edit" href="{{ route('admin.blog.edit',$data->id) }}">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.blog.destroy', $data->id) }}" method="post" class="d-inline" onsubmit="return confirm('Do you want to delete this data?')">
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
    </div>

@endsection
