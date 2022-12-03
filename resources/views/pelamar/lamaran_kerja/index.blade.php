@extends('layouts.app')

@section('container')
  <div class="container mb-5" style="margin-top: 120px;">
    <div class="row gap-4 gap-md-0">
      @include('pelamar.action')
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h3>Progress Lamaran Kerja</h3>
            <a href="#" class="btn btn-primary" type="button">Tambah</a>
          </div>
          <div class="card-body">
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
