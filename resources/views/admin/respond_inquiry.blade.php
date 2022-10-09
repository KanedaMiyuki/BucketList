@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 mt-3">
                <form action="{{ route('admin.update', $inquiry->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                      <div class="card-header">
                        <h1 class="fw-bold text-center">Respond Inquiry</h1>
                      </div>

                      <div class="card-body">
                        <h5>Name: <strong>{{ $inquiry->name}}</strong></h5>
                        <h5>Email: <strong>{{ $inquiry->email}}</strong></h5>
                        <h5>About: <strong>{{ $inquiry->about}}</strong></h5>
                        <h5>Detail: <br>{{ $inquiry->details}}</h5>

                        <label for="details"class="form-label mt-2">{{ __('Details') }}</label>
                        <textarea name="details" id="details" cols="30" rows="10" class="form-control" required autofocus>Deatils: {{ $inquiry->details }}</textarea>
                        @error('details')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror

                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="" class="form-select">
                            <option value="" >{{ $inquiry->status }}</option>
                            <option value="対応中">対応中</option>
                            <option value="完了">完了</option>
                        </select>

                      </div>
                        <div class="card-footer">
                          <button type="submit" class="btn btn-warning w-100">Submit</button>
                          <a href="/check_inquiries" class="btn btn-outline-dark w-100 mt-3">Back</a>
                        </div>

                    </form>

            </div>
        </div>
    </div>
</div>
@endsection
