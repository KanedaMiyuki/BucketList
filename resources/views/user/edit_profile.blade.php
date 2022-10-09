@extends('layouts.app')
@section('title')
@section('content')

<div class="container">
    <div class="card my-3">
        <div class="card-body">
            <form action="{{ route('users.update') }}" method="post">
            @csrf
            @method('PUT')
            <h2 class="card-title">Profile</h2>
            <label for="name" class="form-label">{{ __('Username') }}</label>
            <input type="text" name="name" id="" class="form-control" value="{{ $user->name }}">
            @error('name')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror

            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="email" name="email" id="" class="form-control" value="{{ $user->email }}">
            @error('email')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror

            <label for="privacy">Privacy</label>
            <select name="privacy" id="" class="form-select">
                <option value="{{ $user->privacy }}" selected disabled>{{ $user->privacy }}</option>
                <option value="ON">ON</option>
                <option value="OFF">OFF</option>
            </select>

            <button type="submit" class="btn btn-warning mt-2">Change</button>
            <a href="{{ route('users.index') }}" class="btn btn-dark mt-2">Back</a>
            </form>
        </div>
    </div>
</div>

@endsection
