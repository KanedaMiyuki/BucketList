@extends('layouts.app')
@section('title')
@section('content')

<div class="container">
    <div class="card my-3">
        <div class="card-body">
            <form action="{{ route('users.updatePassword') }}" method="post">
            @csrf
            @method('PUT')
            <h2 class="card-title">Change Password</h2>

            <label for="password" class="form-label">{{ __('New Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>

            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

            <button type="submit" class="btn btn-warning mt-2">Change Password</button>
            <a href="{{ route('users.index') }}" class="btn btn-dark mt-2">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection
