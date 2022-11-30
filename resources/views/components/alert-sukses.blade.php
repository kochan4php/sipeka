@if (session()->has('sukses'))
  <div class="row">
    <div class="col">
      <div class="fs-6 alert alert-success alert-dismissible fade show">
        {{ session('sukses') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
  </div>
@endif
