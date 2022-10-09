@extends('layouts.app')
@section('title')
@section('content')

<div class="container">
@include('components._message')
    <div class="card my-3">
        <div class="card-body">
        <form action="{{ route('contact.store') }}" method="post">
        @csrf
            <h5 class="card-title">Contact Form</h5>
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" name="name" id="" class="form-control" required>
            @error('name')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror

            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="email" name="email" id="" class="form-control" required>
            @error('email')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror

            <label for="about" class="form-label">{{ __('About') }}</label>
            <select name="about" id="" class="form-select" required>
                <option value="" selected disabled>Choose from here</option>
                <option value="U/I">U/I</option>
                <option value="Account">Account</option>
                <option value="Other">Other</option>
            </select>
            @error('about')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror

            <label for="details" class="form-label">{{ __('Details') }}</label>
            <textarea name="details" id="" cols="30" rows="10" class="form-control" required></textarea>
            @error('details')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror

            <button class="btn btn-warning mt-2" type="submit">Send</button>
            <a href="/" class="btn btn-dark mt-2 ms-3">Back</a>
        </form>
        </div>
    </div>
</div>
@endsection
