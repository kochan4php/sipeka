@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="row pt-3 pb-1 mb-1 gap-4">
    <div class="col-12">
      <div class="card">
        <div class="card-header pb-0">
          <div class="col text-center">
            <h2>Profil Saya</h2>
          </div>
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <div class="col d-flex align-items-center justify-content-center">
              @if (is_null($mitra->foto_sampul_perusahaan))
                <img src="{{ asset('assets/images/no-photo.png') }}" class="img-fluid" alt="Foto Sampul Mitra"
                  draggable="false" width="600">
              @else
                <img src="{{ asset('storage/' . $mitra->foto_sampul_perusahaan) }}" alt="{{ $mitra->username }}"
                  class="img-fluid" width="600" draggable="false">
              @endif
            </div>
          </div>
          <hr />
          <div class="row my-4">
            <div class="col-lg-3 text-center mb-4 mb-lg-0 d-flex align-items-center justify-content-center">
              @if (is_null($mitra->logo_perusahaan))
                <img
                  src="{{ Avatar::create($mitra->user->email)->toGravatar(['d' => 'identicon', 'r' => 'pg', 's' => 1000]) }}"
                  alt="{{ $mitra->username }}" class="rounded-circle border border-secondary" width="170"
                  draggable="false">
              @else
                <img src="{{ asset('storage/' . $mitra->logo_perusahaan) }}" alt="{{ $mitra->username }}" width="170"
                  draggable="false">
              @endif
            </div>
            <div class="col-lg-9">
              <table class="table table-responsive">
                <tbody>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Nama Mitra') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">
                      {{ $mitra->nama_perusahaan }}
                    </td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Email Mitra') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __($mitra->user->email) }}</td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Kategori Mitra') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __($mitra->kategori_perusahaan) }}</td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Username') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __($mitra->user->username) }}</td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('No. Telepon / Fax') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __($mitra->nomor_telp_perusahaan) }}</td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Deskripsi') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">
                      {!! $mitra->deskripsi_perusahaan ?? '-' !!}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12">
      <div class="card">
        <div class="card-header text-center pb-0">
          <h3>Edit Profile</h3>
        </div>
        <div class="card-body pb-0">
          <x-alert-error-validation />
          <form action="{{ route('perusahaan.profile.index') }}" method="POST">
            @csrf
            @method('put')
            <div class="mb-3 row custom-font">
              <label for="nis" class="col-sm-4 col-form-label text-md-end">
                {{ __('Nama Mitra') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan"
                  placeholder="Bangun Kreatif Abadi" required
                  value="{{ old('nama_perusahaan', $mitra->getRawOriginal('nama_perusahaan')) }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="jenis_perusahaan" class="custom-font col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Jenis Perusahaan') }}
              </label>
              <div class="col-sm-8">
                <select name="jenis_perusahaan" id="jenis_perusahaan" class="form-select" required>
                  <option selected disabled hidden>-- Pilih Jenis Perusahaan --</option>
                  <option value="PT" @selected($mitra->jenis_perusahaan === 'PT')>PT</option>
                  <option value="CV" @selected($mitra->jenis_perusahaan === 'CV')>CV</option>
                  <option value="Persero" @selected($mitra->jenis_perusahaan === 'Persero')>Persero</option>
                  <option value="Firma" @selected($mitra->jenis_perusahaan === 'Firma')>Firma</option>
                </select>
              </div>
            </div>
            <div class="mb-3 row custom-font">
              <label for="nis" class="col-sm-4 col-form-label text-md-end">
                {{ __('Email Mitra') }}
              </label>
              <div class="col-sm-8">
                <input type="email" class="form-control" id="email_perusahaan" name="email_perusahaan"
                  placeholder="Bangun Kreatif Abadi" required value="{{ old('email_perusahaan', $mitra->user->email) }}">
              </div>
            </div>
            <div class="mb-3 row custom-font">
              <label for="nis" class="col-sm-4 col-form-label text-md-end">
                {{ __('Username Mitra') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="username_perusahaan" name="username_perusahaan"
                  placeholder="bangun-kreatif-abadi" required
                  value="{{ old('username_perusahaan', $mitra->user->username) }}">
              </div>
            </div>
            <div class="mb-3 row custom-font">
              <label for="nis" class="col-sm-4 col-form-label text-md-end">
                {{ __('Kategori Mitra') }}
              </label>
              <div class="col-sm-8">
                <select name="kategori_perusahaan" id="kategori_perusahaan" class="form-select" required>
                  <option selected disabled hidden>-- Pilih Kategori Mitra --</option>
                  @foreach ($kategori as $item)
                    <option value="{{ $item }}" @selected($item === $mitra->kategori_perusahaan)>{{ $item }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="mb-3 row custom-font">
              <label for="nis" class="col-sm-4 col-form-label text-md-end">
                {{ __('No. Telepon / Fax') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="nomor_telp_perusahaan" name="nomor_telp_perusahaan"
                  placeholder="089889287463" required
                  value="{{ old('nomor_telp_perusahaan', $mitra->nomor_telp_perusahaan) }}">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-4"></div>
              <div class="col-sm-8 d-flex gap-2">
                <button type="submit" class="btn custom-btn btn-primary">Perbarui</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-12">
      <div class="card">
        <div class="card-header text-center pb-0">
          <h3>Ubah Password</h3>
        </div>
        <div class="card-body pb-0">
          <form action="{{ route('change.password') }}" method="POST">
            @csrf
            <div class="mb-3 row custom-font">
              <label for="old_password" class="col-sm-4 col-form-label text-md-end">
                {{ __('Password lama') }}
              </label>
              <div class="col-sm-8">
                <input type="password" class="form-control" id="old_password" name="old_password" required>
              </div>
            </div>
            <div class="mb-3 row custom-font">
              <label for="new_password" class="col-sm-4 col-form-label text-md-end">
                {{ __('Password baru') }}
              </label>
              <div class="col-sm-8">
                <input type="password" class="form-control" id="new_password" name="new_password" required>
              </div>
            </div>
            <div class="mb-3 row custom-font">
              <label for="new_password_confirmation" class="col-sm-4 col-form-label text-md-end">
                {{ __('Konfirmasi password baru') }}
              </label>
              <div class="col-sm-8">
                <input type="password" class="form-control" id="new_password_confirmation"
                  name="new_password_confirmation" required>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-4"></div>
              <div class="col-sm-8 d-flex gap-2">
                <button type="submit" class="btn custom-btn btn-primary">Perbarui password</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
