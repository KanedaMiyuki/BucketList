@extends('layouts.app')

@section('content')
@include('components._message')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/home" class="text-decoration-none text-dark"><i class="fa-solid fa-arrow-left"></i>Back</a>
            <div class="card border-0 mt-3">

                <div class="card-header">
                    <h1 class="fw-bold text-center">Account Administration</h1>
                </div>
                <div class="card-body bg-light">
                  <form action="/account_administration" class="row row-cols-md-auto mt-3">
                    <div class="mx-auto">
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa fa-search"></i></div>
                            <input type="text" class="form-control" name="search" id="search" placeholder="Enter ID or Name here">
                            <button type="submit" class="btn btn-info">Search</button>

                            <a href="/account_administration" class="btn btn-light btn-outline-dark">Reset</a>
                          </div>
                    </div>
                  </form>
                  <div class="my-5">{{ $users->links() }}</div>

                  <table class="table table-light">
                    <thead class="text-center">
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th></th>
                      <th></th>
                    </thead>

                      @foreach ($users as $user)
                      <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        @if ($user->status == 0)
                            @if ($user->admin == 1)
                                <td><h4>Admin</h4></td>
                            @else
                                <form action="/account_administration/suspended/{{ $user->id }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <td>
                                    <button type="submit" class="btn btn-danger">停止</button>
                                    </td>
                                </form>
                            @endif

                        @else

                            <form action="/account_administration/reversed/{{ $user->id }}" method="POST">
                              @csrf
                              @method('PATCH')
                              <td>
                                <button type="submit" class="btn btn-warning">再開</button></td>
                            </form>
                        @endif
                        @endforeach
                    </tr>
                  </table>
                </div>
        </div>
    </div>
</div>
@endsection
