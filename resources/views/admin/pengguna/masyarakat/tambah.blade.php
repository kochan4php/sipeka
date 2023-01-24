@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="row pt-3 pb-1 mb-1">
    <div class="col">
      <div class="card">
        <div class="card-header pb-0">
          <h2>Tambah data pelamar</h2>
        </div>
        <div class="card-body">
          <x-alert-error-validation />
          <form action="{{ route('admin.pelamar.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
              <label for="nama" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Nama Lengkap') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Aphrodeo Subarno"
                  value="{{ old('nama') }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="password" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Password') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="password" name="password" placeholder="********"
                  value="password" readonly>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="jenis_kelamin" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Jenis Kelamin') }}
              </label>
              <div class="col-sm-8">
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                  <option selected disabled hidden>-- Pilih jenis kelamin --</option>
                  <option value="L">Laki-laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="no_telp" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('No. Telepon') }}
              </label>
              <div class="col-sm-8">
                <input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="08988976056"
                  value="{{ old('no_telp') }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tempat_lahir" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Tempat Lahir') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Bekasi">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tanggal_lahir" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Tanggal Lahir') }}
              </label>
              <div class="col-sm-8">
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                  placeholder="04/18/2005" value="{{ old('tanggal_lahir') }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="alamat" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Alamat Tempat Tinggal') }}
              </label>
              <div class="col-sm-8">
                <textarea class="form-control" placeholder="Leave a comment here" id="alamat" name="alamat" rows="3"></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4"></div>
              <div class="col-sm-8">
                <img class="d-block image-preview rounded" width="300">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="image" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Foto') }}
              </label>
              <div class="col-sm-8">
                <input type="file" class="form-control" id="image" name="foto_pelamar">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-4"></div>
              <div class="col-sm-8 d-flex gap-2">
                <button type="submit" class="btn custom-btn btn-primary">Tambah</button>
                <a href="{{ route('admin.pelamar.index') }}" class="btn custom-btn btn-danger">Batal</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  @push('script')
    <script src="{{ asset('assets/js/preview_image.js') }}"></script>
  @endpush
@endsection
