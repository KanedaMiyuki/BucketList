@extends('layouts.app')

@section('content')
<div class="container">
@include('components._message')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/home" class="btn btn-dark">Back</a>
            <div class="card border-0 mt-3">
                <div class="card-header">
                    <h1 class="fw-bold text-center">Add Admin</h1>
                </div>
                <div class="card-body bg-light">
                  <form action="/add_admin" class="row row-cols-md-auto mt-3">
                    <div class="mx-auto">
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa fa-search"></i></div>
                            <input type="text" class="form-control" name="search" id="search" placeholder="Enter ID or Name here">
                            <button type="submit" class="btn btn-dark">Search</button>

                            <a href="/add_admin" class="btn btn-light btn-outline-dark">Reset</a>
                          </div>
                    </div>
                  </form>
                  <div class="my-5">{{ $users->links() }}</div>

                  <table class="table table-light">
                    <thead>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th></th>
                    </thead>

                      @foreach ($users as $user)
                      <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        {{-- <td>{{ $user->admin }}</td> --}}
                        @if ($user->admin == 0)
                            <form action="/changeUsertype_Admin/{{ $user->id }}" method="POST">
                              @csrf
                              @method('PATCH')
                              <td>
                                <button type="submit" class="btn btn-warning">Add Admin</button>
                              </td>
                            </form>
                        @else
                            <form action="/changeUsertype_User/{{ $user->id }}" method="POST">
                              @csrf
                              @method('PATCH')
                              <td>
                                <button type="submit" class="btn btn-danger">Change as User</button></td>
                            </form>
                        @endif
                        @endforeach
                    </tr>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
