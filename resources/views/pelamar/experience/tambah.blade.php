@extends('layouts.app')

@section('container')
  <div class="container mb-5" style="margin-top: 120px;">
    <div class="row gap-4 gap-md-0">
      @include('pelamar.action')
      <div class="col-lg-9">
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h3>Tambah Experience</h3>
            <a href="{{ route('pelamar.experience.index', Auth::user()->username) }}" class="btn btn-danger"
              type="button">Batal</a>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12">
                <x-alert-error-validation />
                <form action="{{ route('pelamar.experience.store', Auth::user()->username) }}" method="POST">
                  @csrf
                  <div class="mb-3 row">
                    <label for="judul_posisi" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                      {{ __('Judul Posisi') }}
                    </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="judul_posisi" name="judul_posisi"
                        placeholder="UI/UX Designer" required>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="nama_perusahaan" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                      {{ __('Nama Perusahaan') }}
                    </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan"
                        placeholder="PT. Tokopedia Indonesia" required>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="id_jenis_pekerjaan" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                      {{ __('Jenis Pekerjaan') }}
                    </label>
                    <div class="col-sm-8">
                      <select name="id_jenis_pekerjaan" id="id_jenis_pekerjaan" class="form-select" required>
                        <option selected>-- Jenis Pekerjaan --</option>
                        @foreach ($jenisPekerjaan as $jp)
                          <option value="{{ $jp->id_jenis_pekerjaan }}">{{ $jp->nama_jenis_pekerjaan }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="tanggal_masuk" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                      {{ __('Tanggal Masuk') }}
                    </label>
                    <div class="col-sm-8">
                      <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="tanggal_selesai" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                      {{ __('Tanggal Selesai') }}
                    </label>
                    <div class="col-sm-8">
                      <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="deskripsi_pengalaman" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                      {{ __('Deskripsi Pengalaman') }}
                    </label>
                    <div class="col-sm-8">
                      <textarea class="form-control" placeholder="Leave a comment here" id="deskripsi_pengalaman" name="deskripsi_pengalaman"
                        rows="3"></textarea>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-8 d-flex gap-2">
                      <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
