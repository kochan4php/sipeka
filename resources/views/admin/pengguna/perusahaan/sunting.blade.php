@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="row pt-3 pb-1 mb-1">
    <div class="col">
      <div class="card">
        <div class="card-header pb-0">
          <h2>Sunting data perusahaan</h2>
        </div>
        <div class="card-body">
          <x-alert-error-validation />
          <form action="{{ route('admin.perusahaan.update', $perusahaan->username) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3 row">
              <label for="nama_perusahaan" class="custom-font col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Nama Perusahaan') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan"
                  placeholder="PT. Catur Jaya Solusi Bersama"
                  value="{{ old('nama_perusahaan', $perusahaan->nama_perusahaan) }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="email_perusahaan" class="custom-font col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Email Perusahaan') }}
              </label>
              <div class="col-sm-8">
                <input type="email" class="form-control" id="email_perusahaan" name="email_perusahaan"
                  placeholder="example@company.com" value="{{ old('email_perusahaan', $perusahaan->email) }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="password_perusahaan" class="custom-font col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Password Perusahaan') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="password_perusahaan" name="password_perusahaan"
                  placeholder="password" value="perusahaan" readonly>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="kategori_perusahaan" class="custom-font col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Kategori Perusahaan') }}
              </label>
              <div class="col-sm-8">
                <select name="kategori_perusahaan" id="kategori_perusahaan" class="form-select" required>
                  <option selected disabled hidden>-- Pilih kategori perusahaan --</option>
                  @foreach ($kategori as $item)
                    <option value="{{ $item }}" @selected($item == $perusahaan->kategori_perusahaan)>{{ $item }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="jenis_perusahaan" class="custom-font col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Jenis Perusahaan') }}
              </label>
              <div class="col-sm-8">
                <select name="jenis_perusahaan" id="jenis_perusahaan" class="form-select" required>
                  <option selected disabled hidden>-- Pilih jenis perusahaan --</option>
                  <option value="PT" @selected($perusahaan->jenis_perusahaan === 'PT')>PT</option>
                  <option value="CV" @selected($perusahaan->jenis_perusahaan === 'CV')>CV</option>
                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="no_telepon_perusahaan" class="custom-font col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('No. Telepon Perusahaan') }}
              </label>
              <div class="col-sm-8">
                <input type="number" class="form-control" id="no_telepon_perusahaan" name="no_telepon_perusahaan"
                  placeholder="(021)9987653"
                  value="{{ old('no_telepon_perusahaan', $perusahaan->nomor_telp_perusahaan) }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="foto_sampul_perusahaan" class="custom-font col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Foto Sampul Perusahaan') }}
              </label>
              <div class="col-sm-8">
                <input type="file" class="form-control" id="foto_sampul_perusahaan" name="foto_sampul_perusahaan">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="logo_perusahaan" class="custom-font col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Logo Perusahaan') }}
              </label>
              <div class="col-sm-8">
                <input type="file" class="form-control" id="logo_perusahaan" name="logo_perusahaan">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="deskripsi_perusahaan" class="custom-font col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Deskripsi Perusahaan') }}
              </label>
              <div class="col-sm-8">
                <textarea class="form-control" placeholder="Leave a comment here" id="deskripsi_perusahaan" name="deskripsi_perusahaan"
                  rows="3">
                {{ $perusahaan->deskripsi_perusahaan ?? '' }}
                </textarea>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-4"></div>
              <div class="col-sm-8 d-flex gap-2">
                <button type="submit" class="btn custom-btn btn-primary">Perbarui</button>
                <a href="{{ route('admin.perusahaan.index') }}" class="btn custom-btn btn-danger">Batal</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('script')
  <script>
    const deskripsi = document.getElementById("deskripsi_perusahaan");
    CKEDITOR.replace(deskripsi, {
      language: 'en-gb'
    });
    CKEDITOR.config.allowedContent = true;
  </script>
@endpush
