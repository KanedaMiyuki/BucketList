@extends('layouts.app')
@section('title')
@section('content')

<div class="container">
    <div class="card my-3">
        <div class="card-body">
            <form action="{{ route('users.updatePrivacy', $user) }}" method="post">
            @csrf

            <h2 class="card-title">Privacy</h2>

            <label for="privacy">Privacy</label>
            <select name="privacy" id="privacy" class="form-select">
                <option value="{{ $user->privacy }}" selected disabled>{{ $user->privacy }}</option>
                <option value="ON">ON</option>
                <option value="OFF">OFF</option>
            </select>
            @error('privacy')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror

            <button type="submit" class="btn btn-warning mt-2">Change</button>
            <a href="{{ route('users.index') }}" class="btn btn-dark mt-2">Back</a>
            </form>
        </div>
    </div>
</div>

@endsection
