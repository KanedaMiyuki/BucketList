@extends('layouts.app')

@section('content')
<div class="content">
  <div class="card w-50 mx-auto">
        <div class="card-body text-center bg-warning">
            <h6 class="text-dark">Your Account has been Banned</h6>
            <h1 class="text-danger"><i class="fa-solid fa-ban"></i></h1>
            <a href="{{ route('contact') }}" class="btn btn-dark w-50" id="ban">Contact</a>
        </div>
  </div>
</div>
@endsection
