@extends('layouts.app')
@section('title')
@section('content')

<div class="container">
@include('components._message')
    <h2>{{ $listing->user->name }}'s Bucket List</h2>
    <div class="card mb-3">
        @if ($listing->image)
            <img src="{{ asset('/storage/images/'. $listing->image) }}" alt="{{ $listing->image }}" class="card-img-top text-center">
        @endif
        <div class="card-body">
          <h4 class="card-title">{{ $listing->title }}</h4>
          <p>written by {{ $listing->user->name }}</p>

          @if ($listing->description == null)
            <p class="card-text">No Description</p>
          @else
            <p class="card-text">{!! \Michelf\Markdown::defaultTransform($listing->description) !!}</p>
          @endif

          @php
              $tags = explode(',', $listing->tags)
          @endphp

            @foreach ($tags as $tag)
                <div class="text-start">
                    <a href="/?tag={{ $tag }}" class="list-group-item border-0 fs-6 tags">#{{ $tag }}</a>
                </div>

            @endforeach
          <h5 class="mt-3">Address</h5>
          <h6>{{ $listing->address }}</h6>
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
          @auth
          {{-- ユーザーのみ表示 --}}
            @if(Auth::user()->id === $listing->user_id)
            {{-- banされてなければ --}}
                @if (Auth::user()->status !== 1)
                <a href="{{ route('lists.edit', $listing->id) }}" class="btn btn-success">Edit</a>
                <form action="{{ route('lists.destroy', $listing->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-warning">Delete</button>
                </form>
                @endif
            @endif
            {{-- ログインしてる人だけコメント残せる --}}
          
          <form action="{{ route('comments.store') }}" method="post">
            @csrf
            <input type="hidden" name="listing_id" value="{{ $listing->id }}">

            <label for="comment" class="form-label"></label>
            <input type="text" name="comment" id="" class="form-control" placeholder="Comment here...">
            <button type="submit" class="btn btn-dark my-3">Add Comment</button>
        </form>

            <div class="card-footer">
            @unless (count($comments) == 0)
            @foreach ($comments as $comment)
                <hr>
                <h5>{{ $comment->comment }}</h5>
                <p><strong>{{ $comment->user->name }}</strong> &middot; {{ $comment->created_at->format('Y/m/d H:i') }}</p>
                @if ($comment->user_id == Auth::user()->id)
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-dark" onclick="return confirm('Are you sure to delete?')">Delete</button>
                    </form>
                @endif
            @endforeach
            @else
            <p>No Comments Found</p>
            @endunless
            </div>
          @endauth
        </div>
        <a href="/" class="text-decoration-none text-dark fs-3"><i class="fa-solid fa-arrow-left ms-2"></i> Back</a>
      </div>
</div>

@endsection
