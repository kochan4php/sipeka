@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="row pt-3 pb-1 mb-1">
    <div class="col">
      <div class="card">
        <div class="card-header pb-0">
          <h2>Sunting data alumni</h2>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.alumni.update') }}" method="POST">
            @csrf
            @method('put')
            <div class="mb-3 row">
              <label for="nis" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('NIS (Nomor Induk Siswa)') }}
              </label>
              <div class="col-sm-8">
                <input type="number" class="form-control" id="nis" name="nis" placeholder="202115908">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="nama" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Nama Lengkap') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="inputPassword" name="nama"
                  placeholder="Aphrodeo Subarno">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="jenis-kelamin" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Jenis Kelamin') }}
              </label>
              <div class="col-sm-8">
                <select name="jenis-kelamin" id="jenis-kelamin" class="form-select">
                  <option selected>-- Pilih jenis kelamin --</option>
                  <option value="L">Laki-laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tempat-lahir" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Tempat Lahir') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="tempat-lahir" name="tempat-lahir" placeholder="Bekasi">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tanggal-lahir" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Tanggal Lahir') }}
              </label>
              <div class="col-sm-8">
                <input type="date" class="form-control" id="tanggal-lahir" name="tanggal-lahir"
                  placeholder="04/18/2005">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="no-telepon" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('No. Telepon') }}
              </label>
              <div class="col-sm-8">
                <input type="number" class="form-control" id="no-telepon" placeholder="08988976056">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="alamat-alumni" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Alamat Tempat Tinggal') }}
              </label>
              <div class="col-sm-8">
                <textarea class="form-control" placeholder="Leave a comment here" id="alamat-alumni" name="alamat-alumni"
                  rows="4"></textarea>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="foto-alumni" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Foto Alumni') }}
              </label>
              <div class="col-sm-8">
                <input type="file" class="form-control" id="foto-alumni">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-4"></div>
              <div class="col-sm-8 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="" class="btn btn-danger">Batal</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
