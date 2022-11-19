@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="row pt-3 pb-1 mb-1">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <div class="row mb-3">
            <div class="col">
              <h2>Detail Data Alumni</h2>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-lg-3 text-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="currentColor"
                class="bi bi-person-check-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
              </svg>
            </div>
            <div class="col-lg-9">
              <div class="row">
                <p class="fs-5">
                  {{ __('NIS (Nomor Induk Siswa) : 202119875') }}
                </p>
              </div>
              <div class="row">
                <p class="fs-5">
                  {{ __('Nama Lengkap : Layla Mayrisa') }}
                </p>
              </div>
              <div class="row">
                <p class="fs-5">
                  {{ __('Jenis Kelamin : Perempuan') }}
                </p>
              </div>
              <div class="row">
                <p class="fs-5">
                  {{ __('Tempat Lahir : Bekasi') }}
                </p>
              </div>
              <div class="row">
                <p class="fs-5">
                  {{ __('Tanggal Lahir : 20 Mei 2005') }}
                </p>
              </div>
              <div class="row">
                <p class="fs-5">
                  {{ __('No. Telepon : 083806114303') }}
                </p>
              </div>
              <div class="row">
                <p class="fs-5">
                  {{ __('Alamat : Jl. gsdfgkjh No 09 B, RT.08/RW.02 Bintara, Kota Bekasi, Jawa Barat') }}
                </p>
              </div>
              <div class="row">
                <p class="fs-5">
                  {{ __('Jurusan : Rekayasa Perangkat Lunak') }}
                </p>
              </div>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col">
              <a href="{{ route('admin.alumni.index') }}" class="btn btn-danger">Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
