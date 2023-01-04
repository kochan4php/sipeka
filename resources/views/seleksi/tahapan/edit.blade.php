@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="row pt-3 pb-1 mb-1">
    <div class="col">
      <div class="card">
        <div class="card-header pb-0">
          <h2>Edit Tahapan Seleksi</h2>
        </div>
        <div class="card-body pb-0">
          <x-alert-error-validation />
          <form
            action="{{ route('tahapan.seleksi.update', ['pendaftaran_lowongan' => $pendaftaranLowongan->id_pendaftaran, 'tahapan_seleksi' => $tahapanSeleksi->id_tahapan]) }}"
            method="POST">
            @csrf
            @method('put')
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
              <label for="urutan_tahapan_ke" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Urutan tahapan') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="urutan_tahapan_ke" name="urutan_tahapan_ke" placeholder="1"
                  readonly value="{{ $tahapanSeleksi->urutan_tahapan_ke }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="judul_tahapan" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Judul Tahapan Seleksi') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control @error('judul_tahapan')is-invalid @enderror" id="judul_tahapan"
                  name="judul_tahapan" placeholder="Tes Interview dengan perusahaan yang dituju"
                  value="{{ old('judul_tahapan', $tahapanSeleksi->judul_tahapan) }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="ket_tahapan" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Keterangan Tahapan Seleksi') }}
              </label>
              <div class="col-sm-8">
                <textarea class="form-control @error('ket_tahapan')is-invalid @enderror"
                  placeholder="Pergi ke perusahaan yang dituju untuk melakukan seleksi tes interview" id="ket_tahapan"
                  name="ket_tahapan" rows="5">
                  {{ $tahapanSeleksi->ket_tahapan }}
                </textarea>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-4"></div>
              <div class="col-sm-8 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('tahapan.seleksi.jobApplicationDetails', $pendaftaranLowongan->id_pendaftaran) }}"
                  class="btn btn-danger">Batal</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
