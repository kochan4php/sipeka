@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-1">
    <h2>Beranda</h2>
  </div>
  <div class="row gap-3 gap-md-0 mb-3">
    <x-card-admin bgcolor="text-bg-info">
      @slot('data')
        <div class="d-flex justify-content-between align-items-center">
          <span class="fs-2 fw-bold leading-1px">{{ $jumlah_pengguna }}</span>
          <span><i class="fa-solid fa-user" style="font-size: 3rem"></i></span>
        </div>
      @endslot
      <button type="button" class="btn p-0 border-0 text-decoration-none stretched-link text-dark">
        <h4>Pengguna</h4>
      </button>
    </x-card-admin>
    <x-card-admin bgcolor="text-bg-warning">
      @slot('data')
        <div class="d-flex justify-content-between align-items-center">
          <span class="fs-2 fw-bold leading-1px">{{ $jumlah_masyarakat }}</span>
          <span><i class="fa-solid fa-users" style="font-size: 3rem"></i></span>
        </div>
      @endslot
      <a href="{{ route('admin.pelamar.index') }}" class="text-decoration-none stretched-link text-dark">
        <h4>Kandidat Luar</h4>
      </a>
    </x-card-admin>
    <x-card-admin bgcolor="text-bg-pink">
      @slot('data')
        <div class="d-flex justify-content-between align-items-center">
          <span class="fs-2 fw-bold leading-1px">{{ $jumlah_alumni }}</span>
          <span><i class="fa-solid fa-user-graduate" style="font-size: 3rem"></i></span>
        </div>
      @endslot
      <a href="{{ route('admin.alumni.index') }}" class="text-decoration-none stretched-link text-white">
        <h4>Alumni</h4>
      </a>
    </x-card-admin>
    <x-card-admin bgcolor="text-bg-indigo">
      @slot('data')
        <div class="d-flex justify-content-between align-items-center">
          <span class="fs-2 fw-bold leading-1px">{{ $jumlah_mitra_perusahaan }}</span>
          <span><i class="fa-solid fa-building" style="font-size: 3rem"></i></span>
        </div>
      @endslot
      <a href="{{ route('admin.perusahaan.index') }}" class="text-decoration-none stretched-link text-white">
        <h4>Perusahaan</h4>
      </a>
    </x-card-admin>
    <x-card-admin bgcolor="text-bg-danger">
      @slot('data')
        <div class="d-flex justify-content-between align-items-center">
          <span class="fs-2 fw-bold leading-1px">{{ $jumlah_jurusan }}</span>
          <i class="fa-solid fa-users-gear" style="font-size: 3rem"></i>
        </div>
      @endslot
      <a href="{{ route('admin.jurusan.index') }}" class="text-decoration-none stretched-link text-white">
        <h4>Jurusan</h4>
      </a>
    </x-card-admin>
    <x-card-admin bgcolor="text-bg-primary">
      @slot('data')
        <div class="d-flex justify-content-between align-items-center">
          <span class="fs-2 fw-bold leading-1px">{{ $jumlah_angkatan }}</span>
          <i class="fa-solid fa-graduation-cap" style="font-size: 3rem"></i>
        </div>
      @endslot
      <a href="{{ route('admin.angkatan.index') }}" class="text-decoration-none stretched-link text-white">
        <h4>Angkatan</h4>
      </a>
    </x-card-admin>
    <x-card-admin bgcolor="text-bg-orange">
      @slot('data')
        <div class="d-flex justify-content-between align-items-center">
          <span class="fs-2 fw-bold leading-1px">{{ $jumlah_lowongan }}</span>
          <i class="fa-solid fa-magnifying-glass" style="font-size: 3rem"></i>
        </div>
      @endslot
      <a href="{{ route('lowongankerja.index') }}" class="text-decoration-none stretched-link text-white">
        <h4>Lowongan Kerja</h4>
      </a>
    </x-card-admin>
    <x-card-admin bgcolor="text-bg-success">
      @slot('data')
        <div class="d-flex justify-content-end align-items-center">
          <i class='fa-solid fa-user-check' style='font-size: 3rem'></i>
        </div>
      @endslot
      <button type="button" data-bs-toggle="modal" data-bs-target="#modal_seleksi"
        class="btn p-0 border-0 text-decoration-none stretched-link text-white">
        <h4>Seleksi</h4>
      </button>
    </x-card-admin>
  </div>

  {{-- Modal --}}
  <div class="modal fade" id="modal_seleksi" tabindex="-1" aria-labelledby="label_modal_seleksi" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header border-0 border-bottom-0">
          <h1 class="modal-title fs-4" id="label_modal_seleksi">
            Seleksi
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer border-0 border-top-0 d-flex justify-content-between">
          <a href="{{ route('tahapan.seleksi.index') }}"
            class="text-decoration-none btn w-100 fs-5 btn-info d-flex justify-content-center gap-2 align-items-center">
            <i class="fa-solid fa-code-branch"></i>
            <span>Tahapan Seleksi</span>
          </a>
          <a href="{{ route('penilaian.seleksi.index') }}"
            class="text-decoration-none btn w-100 fs-5 btn-primary d-flex justify-content-center gap-2 align-items-center">
            <i class="fa-solid fa-clipboard-check"></i>
            <span>Penilaian Seleksi</span>
          </a>
          <button type="button" class="btn w-100 fs-5 btn-danger d-flex justify-content-center gap-2 align-items-center"
            data-bs-dismiss="modal">
            <i class="fa-solid fa-xmark"></i>
            <span>Tutup</span>
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection
