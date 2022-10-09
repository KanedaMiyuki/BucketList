@extends('layouts.app')
@section('title')
@section('content')
<div class="container">
@include('components._message')
    {{-- <section class="header"> --}}
        <h1 class="text-center">Welcome to Bucket List</h1>
        <h3 class="text-center mt-3" id="welcome_text">生きてる間にやってみたいことリスト</h3>
        <p class="text-center" id="welcome_p">ユーザー登録すると他のユーザーさんのリストの閲覧やコメントを残すこともできます</p>
    {{-- </section> --}}

    <form action="/" class="row row-cols-md-auto mt-3">
        <div class="col-md-6 offset-md-3">
            <div class="input-group">
                <div class="input-group-text"><i class="fa fa-search"></i></div>
                <input type="text" class="form-control" name="search" id="search" placeholder="Search">
                <button type="submit" class="btn btn-dark">Search</button>
                <a href="/" class="btn btn-outline-dark">Reset</a>
                </div>
        </div>
    </form>

    <div class="mt-4 p-4">
        {{ $listings->links() }}
    </div>
    <div class="w-50 mx-auto">
    @unless (count($listings) === 0)

    @foreach ($listings as $listing)
    @if ($listing->user->privacy === 'OFF')

        <div class="card mb-2 text-center" id="card">
            <div class="card-body">
                <h5 class="card-title" id="card-title">{{ mb_strimwidth($listing->title,0,15,"...") }}</h5>
                @if ($listing->image)
                <img src="{{ asset('/storage/images/'. $listing->image) }}" alt="{{ $listing->image }}" class="text-center" id="cardImage">
                @endif
                @php
                $tags = explode(',', $listing->tags)
                @endphp

                @foreach ($tags as $tag)
                <div class="tags text-start">
                    <a href="/?tag={{ $tag }}" class="list-group-item border-0">#{{ $tag }} </a>
                </div>
                @endforeach
            </div>
            <div class="card-footer">
                <a href="{{ route('show', $listing->id) }}" class="btn btn-outline-secondary" id="detail_btn">Detail</a>
            </div>
        </div>
    @endif
    @endforeach
    @endunless
    </div>
</div>

@endsection

