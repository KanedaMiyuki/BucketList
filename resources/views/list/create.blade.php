@extends('layouts.app')
@section('title')
@section('content')

<div class="container">
    <form action="{{ route('lists.store') }}" method="post" enctype="multipart/form-data">
        @csrf

    <div class="card-body">
        <label for="title" class="form-label">{{ __('Title') }}</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        @error('title')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @enderror

        <label for="description" class="form-label mt-2">{{ __('Description') }}</label>
        <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description') }}</textarea>
        @error('description')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @enderror


        <label for="tags" class="form-label mt-2">
            Tags (Comma Separated)
        </label>
        <input type="text" class="form-control" name="tags" placeholder="Example: Food, Landscape, Place, etc"  value="{{ old('tags') }}">
        @error('tags')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @enderror

        <label for="address" class="form-label mt-2">Address</label>
        <input type="text" class="form-control" name="address" id="" value="{{ old('address') }}">

        <label for="image" class="form-label mt-4">{{ __('Image') }}</label>
        <img src="" alt="">
        <input type="file" name="image" id="image" class="form-control" value="{{ old('image') }}">
        @error('image')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-warning w-100 mt-5">Create List</button>
        <a href="/" class="btn btn-light w-100 mt-3">Back</a>
    </div>
    </form>

</div>

@endsection
