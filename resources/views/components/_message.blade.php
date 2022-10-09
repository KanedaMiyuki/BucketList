@if (session()->has('message'))
<div class="alert alert-info alert-dismissible fade show text-center" role="alert">
    <p>{{ session('message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    </p>
</div>
@endif
