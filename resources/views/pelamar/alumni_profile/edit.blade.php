@extends('layouts.app')

@section('container')
  <div class="container mb-5" style="margin-top: 120px;">
    <div class="row gap-4 gap-md-0">
      @include('pelamar.action')
      <div class="col-lg-9">
        <div class="card card-outline-secondary">
          <div class="card-header d-flex align-items-center justify-content-between pb-0">
            <h3>Edit Saya</h3>
            <h5>{{ $data->pelamar->user->username }}</h5>
          </div>
          <div class="card-body custom-font">
            <x-alert-error-validation />
            <form action="{{ route('pelamar.profile.update', $data->pelamar->user->username) }}" method="POST"
              enctype="multipart/form-data">
              @csrf
              @method('put')
              <div class="mb-3 row">
                <label for="username" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                  {{ __('Username') }}
                </label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="username" name="username" placeholder="202115908"
                    required value="{{ old('username', $data->pelamar->user->username) }}">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="nis" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                  {{ __('NIS (Nomor Induk Siswa)') }}
                </label>
                <div class="col-sm-8">
                  <input type="number" class="form-control" id="nis" name="nis" placeholder="202115908"
                    required value="{{ old('nis', $data->nis) }}">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="nama" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                  {{ __('Nama Lengkap') }}
                </label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputPassword" name="nama"
                    placeholder="Aphrodeo Subarno" required value="{{ old('nama', $data->nama_lengkap) }}">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="jenis_kelamin" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                  {{ __('Jenis Kelamin') }}
                </label>
                <div class="col-sm-8">
                  <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                    <option selected>-- Pilih jenis kelamin --</option>
                    <option value="L" @if ($data->jenis_kelamin === 'L') @selected(true) @endif>Laki-laki</option>
                    <option value="P" @if ($data->jenis_kelamin === 'P') @selected(true) @endif>Perempuan</option>
                  </select>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="jurusan" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                  {{ __('Jurusan') }}
                </label>
                <div class="col-sm-8">
                  <select name="jurusan" id="jurusan" class="form-select" required>
                    <option selected value="">-- Pilih Jurusan --</option>
                    @foreach ($jurusan as $item)
                      <option value="{{ $item->id_jurusan }}" @if ($item->id_jurusan === $data->jurusan->id_jurusan) @selected(true) @endif>
                        {{ $item->nama_jurusan }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="angkatan" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                  {{ __('Angkatan Tahun') }}
                </label>
                <div class="col-sm-8">
                  <select name="angkatan" id="angkatan" class="form-select" required>
                    <option selected>-- Pilih Tahun Angkatan --</option>
                    @foreach ($angkatan as $item)
                      <option value="{{ $item->id_angkatan }}" @if ($item->id_angkatan === $data->angkatan->id_angkatan) @selected(true) @endif>
                        {{ $item->angkatan_tahun }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="tempat_lahir" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                  {{ __('Tempat Lahir') }}
                </label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Bekasi"
                    value="{{ old('tempat_lahir', $data->tempat_lahir) }}">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="tanggal_lahir" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                  {{ __('Tanggal Lahir') }}
                </label>
                <div class="col-sm-8">
                  <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                    placeholder="04/18/2005" value="{{ old('tanggal_lahir', $data->tanggal_lahir) }}">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="no_telp" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                  {{ __('No. Telepon') }}
                </label>
                <div class="col-sm-8">
                  <input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="08988976056"
                    value="{{ old('no_telp', $data->no_telepon) }}">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="alamat_alumni" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                  {{ __('Alamat Tempat Tinggal') }}
                </label>
                <div class="col-sm-8">
                  <textarea class="form-control" id="alamat_alumni" name="alamat_alumni" rows="3">
              {{ old('alamat_alumni', $data->alamat_tempat_tinggal) }}
              </textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-8">
                  @if ($data->foto)
                    <img class="d-block mb-3 image-preview rounded" width="300"
                      src="{{ asset('storage/' . $data->foto) }}">
                  @else
                    <img class="d-block image-preview rounded" width="300">
                  @endif
                </div>
              </div>
              <div class="mb-3 row">
                <label for="image" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                  {{ __('Foto Alumni') }}
                </label>
                <div class="col-sm-8">
                  <input type="file" class="form-control" id="image" name="foto_alumni">
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-4"></div>
                <div class="col-sm-8 d-flex gap-2">
                  <button type="submit" class="custom-btn btn btn-primary">Perbarui</button>
                  <a href="{{ route('pelamar.index', $data->pelamar->user->username) }}"
                    class="custom-btn btn btn-danger">Batal</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  @endsection
