@extends('layouts.app')

@section('content')
<div class="container">
@include('components._message')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 mt-3">

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-text">
                        <h3>Welcome! {{ Auth::user()->name }}</h3>
                    </div>
                    <a href="/add_admin" class="btn btn-info">Add Admin</a>
                    <a href="/check_inquiries"class="btn btn-info">Check Inqueries</a>
                    <a href="/account_administration" class="btn btn-info">Account Administration</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
