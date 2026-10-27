@extends('admin.layouts.app')
@section('title','Create User')
@section('subtitle', 'Create new user with access to Admin Panel')

@section('content')
    <form action={{ route('admin.user.store') }} method="POST">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label-custom">Full Name :</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Email :</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Password :</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn-custom btn-custom-primary">Save</button>
        </div>
    </form>
@endsection
