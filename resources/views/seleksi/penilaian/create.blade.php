@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="row pt-3 pb-1 mb-1">
    <div class="col">
      <div class="card">
        <div class="card-header pb-0">
          <h3>Penilaian Tahapan Seleksi</h3>
        </div>
        <div class="card-body pb-0">
          <x-alert-error-validation />
          <form
            action="{{ route('penilaian.seleksi.store', [
                'pendaftaran_lowongan' => $pendaftaranLowongan->id_pendaftaran,
                'tahapan_seleksi' => $tahapanSeleksi->id_tahapan,
            ]) }}"
            method="POST">
            @csrf
            <div class="mb-3 row">
              <label for="judul_lowongan" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Judul Lowongan') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="judul_lowongan" name="judul_lowongan"
                  value="{{ $pendaftaranLowongan->lowongan->judul_lowongan }}" readonly disabled>
              </div>
            </div>
            @can('admin')
              <div class="mb-3 row">
                <label for="nama_perusahaan" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                  {{ __('Nama Perusahaan') }}
                </label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan"
                    value="{{ $pendaftaranLowongan->lowongan->perusahaan->nama_perusahaan }}" readonly disabled>
                </div>
              </div>
            @endcan
            <div class="mb-3 row">
              <label for="nama_pelamar" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Nama Pelamar') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="nama_pelamar" name="nama_pelamar" readonly disabled
                  value="{{ $namaPelamar }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tahapan_seleksi" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Tahapan Seleksi yang dilakukan') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="tahapan_seleksi" name="tahapan_seleksi" readonly disabled
                  value="{{ $tahapanSeleksi->judul_tahapan }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="nilai" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __("Nilai $tahapanSeleksi->judul_tahapan") }}
              </label>
              <div class="col-sm-8">
                <input type="number" max="100" min="1"
                  class="form-control @error('nilai')is-invalid @enderror" id="nilai" name="nilai" placeholder="90"
                  value="{{ old('nilai') }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="keterangan" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Keterangan Tahapan Seleksi') }}
              </label>
              <div class="col-sm-8">
                <select name="keterangan" class="form-control" id="keterangan">
                  <option selected>-- Keterangan --</option>
                  <option value="Lulus">Lulus</option>
                  <option value="Gagal">Gagal</option>
                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="is_lanjut" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Lanjut ke tahapan berikutnya?') }}
              </label>
              <div class="col-sm-8">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="is_lanjut" id="Ya" value="Ya">
                  <label class="form-check-label" for="Ya">
                    Ya
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="is_lanjut" id="Tidak" value="Tidak">
                  <label class="form-check-label" for="Tidak">
                    Tidak
                  </label>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-4"></div>
              <div class="col-sm-8 d-flex gap-2">
                <button type="submit" class="btn custom-btn btn-primary">Tambah</button>
                <a href="{{ route('penilaian.seleksi.job_application_details', $pendaftaranLowongan->id_pendaftaran) }}"
                  class="btn custom-btn btn-danger">
                  Batal
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
