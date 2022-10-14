@extends('layouts.app')
@section('title', 'My Bucket List')
@section('content')

<div class="container">
@include('components._message')
    <h1>My Bucket List</h1>
    <table class="table" id="index_table">
        <t-head>
            <tr class="text-center">
                <th><i class="fas fa-clipboard"></i></th>
                <th>title</th>
                <th>detail</th>
                <th>Added at</th>
                <th></th>
            </tr>
        </t-head>

        @unless (count($listings) == 0)
        @foreach ($listings as $listing)
        <tr class="text-center">
            <td><a href="{{ route('show', $listing->id) }}" class="btn btn-dark btn-sm">See</a></td>

            <td>{{ $listing->title }}</td>
            <td>{{ $listing->description }}</td>
            <td>{{ $listing->created_at->format('Y/m/d h:i') }}</td>
            <td>
                <a href="{{ route('lists.edit', $listing->id) }}" class="btn btn-success">Edit</a>
                <form action="{{ route('lists.destroy', $listing->id) }}" method="post">
                    @csrf
                    @method('delete')
                <button type="submit" class="btn btn-warning mt-2">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        @endunless

    </table>

</div>

@endsection
