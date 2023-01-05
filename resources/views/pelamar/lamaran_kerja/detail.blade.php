@extends('layouts.app')

@section('container')
  <div class="container mb-5" style="margin-top: 120px;">
    <div class="row gap-4 gap-md-0">
      {{-- @include('pelamar.action.') --}}
      <div class="col-lg-8">
        <div class="card rounded shadow border-0">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h3> Detail Progress </h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-8 d-flex gap-2">
                <img src="{{ asset('assets/images/7.jpeg') }}" style="width: 95px" alt="image">
                <h4 class="fw-bold fs-1">Manager</h4>
              </div>
              <div class="col-md-4">
                <div style="text-align: right">
                  <h1 class="fw-bold fs-1">Gagal</h1>
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col">
                <p class="text-muted small">PT SOPI</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
