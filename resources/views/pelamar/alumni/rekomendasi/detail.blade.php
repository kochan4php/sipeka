@extends('layouts.app')

@section('container')
  <div class="container mb-5" style="margin-top: 120px;">
    <div class="row gap-4 gap-md-0">
      @include('pelamar.action')
      <div class="col-lg-9">
        <div class="card card-outline-secondary">
          <div class="card-header d-flex align-items-center justify-content-between pb-0">
            <h3>Rekomendasi Loker</h3>
            <h5>{{ Auth::user()->alumni->nama_lengkap }}</h5>
          </div>
          <div class="card-body custom-font">
            <div class="row mb-3">
              <div class="col-sm-12 d-flex flex-column gap-3">
                <div class="card">
                  <div class="card-body pb-2">
                    <div class="d-flex justify-content-between">
                      <div>
                        <h5 class="fw-bold">{{ $rekomendasi->judul }}</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-5">
                <div class="card">
                  <img src="{{ $rekomendasi->logo_perusahaan ?? asset('assets/images/no-photo.png') }}"
                    class="card-img-top" alt="{{ $rekomendasi->judul_lowongan }}">
                  <div class="card-body ">
                    <a class="card-title text-decoration-none text-black font-bolder stretched-link"
                      href="{{ route('lowongan_kerja', $rekomendasi->slug) }}">
                      <h4>{{ $rekomendasi->judul_lowongan }}</h4>
                    </a>
                    <p class="card-text">
                      <span>Perusahaan : </span>
                      <span class="fw-bold fst-italic">
                        {{ __("{$rekomendasi->jenis_perusahaan}. {$rekomendasi->nama_perusahaan}") }}
                      </span>
                    </p>
                    <div class="card-text">{!! $rekomendasi->deskripsi_lowongan !!}</div>
                  </div>
                </div>
              </div>
              <div class="col-sm-7">
                <div class="card">
                  <div class="card-body">
                    <p class="card-text">
                      <span style="font-size: 1.1rem !important;">{{ $rekomendasi->deskripsi }}</span>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endsection
