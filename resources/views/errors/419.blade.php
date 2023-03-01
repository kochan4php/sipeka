@extends('errors.layouts', ['title' => '403 Forbidden'])

@section('error')
  <div class="row justify-content-center align-items-center">
    <div class="col-md-6">
      <div class="card text-center">
        <div class="card-body">
          <h1 class="not-found-title">419</h1>
          <p class="fs-5 mb-3"><span class="text-danger">Opps!</span> {{ $exception->getMessage() ?? 'Forbidden' }}</p>
          <a href="{{ route('home') }}" class="btn custom-btn btn-primary">Kembali</a>
        </div>
      </div>
    </div>
  </div>
@endsection
