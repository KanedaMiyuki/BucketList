@extends('layouts.app')
@section('title')
@section('content')

<div class="container">
@include('components._message')
    <div class="card my-3">
        <div class="card-body">
            <h2 class="card-title">Profile</h2>
            <label for="" class="form-label">{{ __('Username') }}</label>
            <h4>{{ $user->name }}</h4>
            <label for="" class="form-label">{{ __('Email') }}</label>
            <h4>{{ $user->email }}</h4>
            <label for="">Privacy</label>
            <p class="privacy">あなたしか閲覧できないように設定できます</p>
            <h4>{{ $user->privacy }}</h4>
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-dark">Edit</a>
            <a href="{{ route('users.changePassword') }}" class="btn btn-warning">Change Password</a>
        </div>
    </div>
</div>

@endsection
