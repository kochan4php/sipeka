@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-1">
    <h2>Beranda</h2>
  </div>
  <div class="row gap-3 gap-md-0 mb-3">
    <div class="col-md-6 col-lg-4 mb-md-3">
      <div class="card text-bg-info">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold leading-1px">{{ $jumlah_pengguna }}</span>
            <span><i class="fa-solid fa-user" style="font-size: 3rem"></i></span>
          </div>
          <div class="mt-4">
            <h4>Jumlah Pengguna</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-md-3">
      <div class="card text-bg-warning">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold leading-1px">{{ $jumlah_masyarakat }}</span>
            <span><i class="fa-solid fa-users" style="font-size: 3rem"></i></span>
          </div>
          <div class="mt-4">
            <h4>Jumlah Masyarakat</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-md-3">
      <div class="card text-bg-secondary">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold leading-1px">{{ $jumlah_alumni }}</span>
            <span><i class="fa-solid fa-user-graduate" style="font-size: 3rem"></i></span>
          </div>
          <div class="mt-4">
            <h4>Jumlah Alumni</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-md-3">
      <div class="card text-bg-indigo">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold leading-1px">{{ $jumlah_mitra_perusahaan }}</span>
            <span><i class="fa-solid fa-building" style="font-size: 3rem"></i></span>
          </div>
          <div class="mt-4">
            <h4>Jumlah Perusahaan</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-md-3">
      <div class="card text-bg-danger">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold leading-1px">{{ $jumlah_jurusan }}</span>
            <span><i class="fa-solid fa-users-gear" style="font-size: 3rem"></i></span>
          </div>
          <div class="mt-4">
            <h4>Jumlah Jurusan</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-md-3">
      <div class="card text-bg-success">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold leading-1px">{{ $jumlah_angkatan }}</span>
            <span><i class="fa-solid fa-graduation-cap" style="font-size: 3rem"></i></span>
          </div>
          <div class="mt-4">
            <h4>Jumlah Angkatan</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
