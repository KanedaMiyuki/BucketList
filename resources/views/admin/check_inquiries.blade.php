@extends('layouts.app')

@section('content')
@include('components._message')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/home" class="btn btn-dark">Back</a>
            <div class="card border-0 mt-3">
                <div class="card-header">
                    <h1 class="fw-bold text-center">Check Inquiries</h1>
                </div>
                <div class="card-body bg-light">
                  <form action="{{ route('check') }}" class="row row-cols-md-auto mt-3">
                    <div class="mx-auto">
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa fa-search"></i></div>
                            <input type="text" class="form-control" name="search" id="search" placeholder="Search">
                            <button type="submit" class="btn btn-dark">Search</button>

                            <a href="/check_inquiries" class="btn btn-light btn-outline-dark">Reset</a>
                          </div>
                    </div>
                  </form>
                  <div class="my-5">{{ $inquiries->links() }}</div>

                  <div class="container" id="check_inquiries">
                    <table class="table table-light" >
                        <thead>
                          <th>#</th>
                          <th>Date</th>
                          <th>Name</th>
                          {{-- <th>Email</th> --}}
                          <th>About</th>
                          <th>Details</th>
                          <th>Status</th>
                          <th>Responder</th>
                          <th></th>
                        </thead>
                          @unless (count($inquiries) == 0)

                          @foreach ($inquiries as $inquiry)
                              <tr>
                                <td>{{ $inquiry->id }}</td>
                                <td>{{ $inquiry->created_at->format('Y/m/d H:i') }}</td>
                                <td>{{ $inquiry->name }}</td>
                                {{-- <td>{{ $inquiry->email }}</td> --}}
                                <td>{{ $inquiry->about }}</td>
                                <td>{{ $inquiry->details }}</td>
                                <td>{{ $inquiry->status }}</td>
                                <td>{{ $inquiry->responder }}</td>
                                <td><a href="/respond_inquiry/{{ $inquiry->id }}" class="btn btn-warning btn-small">Respond</a>
                                    <a href="/show_inquiry/{{ $inquiry->id }}" class="btn btn-success btn-small">Detail</td>
                              </tr>
                        @endforeach
                        @else
                                <td colspan="6" class="text-center fst-italic fw-bold h5">No Inquiries Found</td>
                        @endunless
                      </table>


                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
