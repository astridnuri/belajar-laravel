@extends('admin.layouts.app')
@section('title','Edit User')
@section('subtitle', 'Edit user')

@section('content')
    <form action={{ route('admin.user.update', $user) }} method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="" class="form-label-custom">Full Name :</label>
            <input type="text" class="form-control" name="name" required value="{{ old('name', $user->name) }}">
            @error('name')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Email :</label>
            <input type="email" class="form-control" name="email" required value="{{ old('email', $user->email) }}">
            @error('email')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">New Password :</label>
            <input type="password" class="form-control" name="password">
            <div class="form-text">
                <small>Fill in if you want to change password. Otherwise, left empty.</small>
            </div>
            @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn-custom btn-custom-primary">Save</button>
        </div>
    </form>
@endsection
