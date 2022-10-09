@extends('layouts.app')
@section('title')
@section('content')

<div class="container">
    <h2>Edit No. {{ $listing->id }}</h2>
    <form action="{{ route('lists.update', $listing->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <input type="hidden" name="id">

    <div class="card-body">
        <label for="title" class="form-label">{{ __('Title') }}</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ $listing->title }}" required>
        @error('title')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @enderror

        <label for="description" class="form-label mt-2">{{ __('Description') }}</label>
        <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $listing->description }}</textarea>
        @error('description')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @enderror


        <label for="tags" class="form-label mt-2">
            Tags (Comma Separated)
        </label>
        <input type="text" class="form-control" name="tags" placeholder="Example: Food, Landscape, Place, etc"  value="{{ $listing->tags }}">
        @error('tags')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @enderror

        <label for="address" class="form-label mt-2">Address</label>
        <input type="text" class="form-control" name="address" id="" value="{{ $listing->address }}">

        @if ($listing->address != NULL)
            <iframe
                    width="600"
                    height="450"
                    style="border:0"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    src="https://www.google.com/maps/embed/v1/place?key={{ config("services.google-map.apikey") }}
                        &q={{ $listing->address }}">
            </iframe><br>
          @else
            <p>No Address</p>
          @endif

        <br>

        <label for="image" class="form-label mt-4">{{ __('Image') }}</label>
        @if ($listing->image)
        <img src="{{ asset('/storage/images/'. $listing->image) }}" alt="{{ $listing->image }}" class="card-img-top text-center">
        @endif
        <input type="file" name="image" id="image" class="form-control">
        @error('image')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-success w-100 mt-2">Update List</button>
        <a href="{{ route('lists.index') }}" class="btn btn-light w-100 mt-3">Back</a>
    </div>
    </form>

</div>

@endsection
