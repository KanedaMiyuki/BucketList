@extends('layouts.app')

@section('content')
@include('components._message')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 mt-3">
                <div class="card-header">
                    <h1 class="fw-bold text-center text-dark">Inquiry Detail</h1>
                </div>
                <div class="card-body bg-light text-dark">
                  <h4>Name: <strong>{{ $inquiry->name}}</strong></h4>
                  <h4>Email: <strong>{{ $inquiry->email}}</strong></h4>
                  <h4>About: <strong>{{ $inquiry->about}}</strong></h4>
                  <h4>Detail: <br>{{ $inquiry->details}}</h4>
                  <br>
                  <h4>Responder: <strong>{{ $inquiry->responder}}</strong></h4>
                  <h4>Status: <strong>{{ $inquiry->status }}</strong></h4>
                </div>
                <div class="card-footer bg-light">
                  <a href="/respond_inquiry/{{ $inquiry->id }}" class="btn btn-warning w-100">Respond</a>
                  <a href="/check_inquiries" class="btn btn-outline-dark w-100 mt-3">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
