@extends('admin.layouts.app')
@section('title', 'User Management')
@section('subtitle', 'Manage users access to Admin Panel')

@section('content')
    <div class="mb-3" align="right">
        <a href={{ route('admin.user.create') }} class="btn-table-action">
            <i class="bi bi-person-add"></i>Create User
        </a>
    </div>
    <div class="table-responsive">
        <table class="table-custom rounded-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $users as $key=>$data )
                <tr>
                    <td>{{ $key+=1 }}</td>
                    <td class="text-center">{{ $data->name??'' }}</td>
                    <td class="text-center">{{ $data->email??'' }}</td>
                    <td class="text-center">
                        <a class="table-btn-action" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a class="table-btn-action delete" title="Delete">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
