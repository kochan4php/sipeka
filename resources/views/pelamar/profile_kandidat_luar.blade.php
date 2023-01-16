@extends('layouts.app')

@section('container')
  <div class="container mb-5" style="margin-top: 120px;">
    <div class="row gap-4 gap-md-0">
      @include('pelamar.action')
      <div class="col-lg-9">
        <div class="card card-outline-secondary">
          <div class="card-header d-flex align-items-center justify-content-between pb-0">
            <h3>Profil Saya</h3>
            <h5>{{ $data->pelamar->user->username }}</h5>
          </div>
          <div class="card-body custom-font">
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Nama Lengkap</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{ $data->nama_lengkap }}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Tempat Lahir</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                @if (is_null($data->tempat_lahir))
                  {{ __('Data tempat lahir tidak ada') }}
                @else
                  {{ $data->tempat_lahir }}
                @endif
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Tanggal Lahir</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                @if (is_null($data->tanggal_lahir))
                  {{ __('Data tanggal lahir tidak ada') }}
                @else
                  {{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d M Y') }}
                @endif
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Jenis Kelamin</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                @if ($data->jenis_kelamin === 'L')
                  {{ __('Laki-laki') }}
                @elseif ($data->jenis_kelamin === 'P')
                  {{ __('Perempuan') }}
                @endif
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Alamat</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                @if (is_null($data->alamat_tempat_tinggal))
                  {{ __('Data alamat tempat tinggal siswa tidak ada') }}
                @else
                  {{ __($data->alamat_tempat_tinggal) }}
                @endif
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Email</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                @if (is_null($data->pelamar->user->email))
                  {{ __('Email tidak ada') }}
                @else
                  {{ __($data->pelamar->user->email) }}
                @endif
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">No Hp</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                @if (is_null($data->no_telepon))
                  {{ __('No. Telp tidak ada') }}
                @else
                  {{ __($data->no_telepon) }}
                @endif
              </div>
            </div>
            <hr>
            <a href="{{ route('pelamar.profile.edit', Auth::user()->username) }}" class="btn custom-btn btn-primary">
              Edit Profil
            </a>
            <a href="" class="btn custom-btn btn-success">
              Ubah Password
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
