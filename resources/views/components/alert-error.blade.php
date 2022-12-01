@if (session()->has('error'))
  <div class="row">
    <div class="col">
      <div class="fs-6 alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
  </div>
@endif
