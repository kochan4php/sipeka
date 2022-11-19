@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="row pt-3 pb-1 mb-1">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <div class="row mb-3">
            <div class="col">
              <h2>Detail Data Perusahaan</h2>
            </div>
          </div>
          <div class="row mb-3 mb-md-4">
            <div class="col">
              <img src="{{ asset('assets/images/1.jpg') }}" class="img-fluid" alt="Foto Sampul Perusahaan">
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-lg-3 text-center d-none d-lg-block">
              <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="currentColor"
                class="bi bi-person-check-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
              </svg>
            </div>
            <div class="col-lg-9">
              <div class="row">
                <p class="fs-5 fs-md-6">
                  {{ __('Nama Perusahaan : PT. Catur Jaya Solusi Bersama') }}
                </p>
              </div>
              <div class="row">
                <p class="fs-5 fs-md-6">
                  {{ __('No. Telepon Perusahaan : (021)9987653') }}
                </p>
              </div>
              <div class="row">
                <p class="fs-5 fs-md-6">
                  {{ __('Deskripsi Perusahaan : ') }}
                  {!! 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis debitis repellat ducimus illo est odio assumenda ullam, placeat eos, veniam eius porro? Quo maxime recusandae quidem saepe, ad aspernatur reiciendis odio, dolore quos ipsum adipisci perferendis quibusdam ullam odit libero enim vel blanditiis beatae! Omnis atque excepturi dignissimos quas fugiat.' !!}
                </p>
              </div>
              <div class="row">
                <p class="fs-5 fs-md-6">
                  {{ __('Alamat Perusahaan : Jl. Gn. Kerinci II No.897, RT.009/RW.012, Bintara Jaya, Bekasi Kota, Kota Bks, Jawa Barat 17136') }}
                </p>
              </div>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col">
              <a href="{{ route('admin.perusahaan.index') }}" class="btn btn-danger">Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection