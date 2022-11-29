@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="row pt-3 pb-1 mb-1">
    <div class="col">
      <div class="card">
        <div class="card-header pb-0">
          <h2>Sunting data pelamar</h2>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.pelamar.update', $orang->username) }}" method="POST">
            @csrf
            @method('put')
            <div class="mb-3 row">
              <label for="nama" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Nama Lengkap') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Aphrodeo Subarno"
                  value="{{ old('nama', $orang->nama_lengkap) }}">
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
              <label for="email" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Email') }}
              </label>
              <div class="col-sm-8">
                <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com"
                  value="{{ old('email', $orang->email) }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="jenis_kelamin" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Jenis Kelamin') }}
              </label>
              <div class="col-sm-8">
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                  <option selected>-- Pilih jenis kelamin --</option>
                  <option value="L" @if ($orang->jenis_kelamin === 'L') @selected(true) @endif>Laki-laki</option>
                  <option value="P" @if ($orang->jenis_kelamin === 'P') @selected(true) @endif>Perempuan</option>
                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="no_telp" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('No. Telepon') }}
              </label>
              <div class="col-sm-8">
                <input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="08988976056"
                  value="{{ old('no_telp', $orang->no_telepon) }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tempat_lahir" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Tempat Lahir') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Bekasi"
                  value="{{ old('tempat_lahir', $orang->tempat_lahir) }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tanggal_lahir" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Tanggal Lahir') }}
              </label>
              <div class="col-sm-8">
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                  placeholder="04/18/2005" value="{{ old('tanggal_lahir', $orang->tanggal_lahir) }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="alamat" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Alamat Tempat Tinggal') }}
              </label>
              <div class="col-sm-8">
                <textarea class="form-control" placeholder="Leave a comment here" id="alamat" name="alamat" rows="3">
                  {{ $orang->alamat_tempat_tinggal }}
                </textarea>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="foto_pelamar" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Foto') }}
              </label>
              <div class="col-sm-8">
                <input type="file" class="form-control" id="foto_pelamar" name="foto_pelamar">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-4"></div>
              <div class="col-sm-8 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('admin.pelamar.index') }}" class="btn btn-danger">Batal</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
