@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="row pt-3 pb-1 mb-1">
    <div class="col">
      <div class="card">
        <div class="card-header pb-0">
          <h2>Sunting Lowongan Kerja</h2>
        </div>
        <div class="card-body">
          @if (!empty($errors->all()))
            <div class="row">
              <div class="col">
                <div class="alert pb-0 alert-danger alert-dismissible fade show fs-6" role="alert">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
            </div>
          @endif
          <form action="{{ route('lowongankerja.update', $lowongan->slug) }}" method="POST">
            @csrf
            @method('put')
            <div class="mb-3 row">
              <label for="judul" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Judul Lowongan') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="judul" name="judul_lowongan"
                  placeholder="IT Consultant" required value="{{ $lowongan->judul_lowongan }}">
              </div>
            </div>
            @can('admin')
              <div class="mb-3 row">
                <label for="id_perusahaan" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                  {{ __('Mitra Perusahaan') }}
                </label>
                <div class="col-sm-8">
                  <select name="id_perusahaan" id="id_perusahaan" class="form-select" required>
                    <option selected>-- Pilih Perusahaan --</option>
                    @foreach ($perusahaan as $item)
                      <option value="{{ $item->id_perusahaan }}" @if ($item->id_perusahaan === $lowongan->id_perusahaan) @selected(true) @endif>
                        {{ $item->nama_perusahaan }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
            @endcan
            <div class="mb-3 row">
              <label for="deskripsi" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Deskripsi') }}
              </label>
              <div class="col-sm-8">
                <textarea class="form-control" placeholder="Leave a comment here" id="deskripsi" name="deskripsi_lowongan"
                  rows="5">{{ $lowongan->deskripsi_lowongan }}</textarea>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tanggal_dimulai" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Tanggal Dimulai') }}
              </label>
              <div class="col-sm-8">
                <input type="date" class="form-control" id="tanggal_dimulai" name="tanggal_dimulai"
                  placeholder="28/12/2022" value="{{ $lowongan->tanggal_dimulai }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tanggal_berakhir" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Tanggal Berakhir') }}
              </label>
              <div class="col-sm-8">
                <input type="date" class="form-control" id="tanggal_berakhir" name="tanggal_berakhir"
                  placeholder="28/12/2022" value="{{ $lowongan->tanggal_berakhir }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="gambar_lowongan" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Gambar Lowongan') }}
              </label>
              <div class="col-sm-8">
                <input type="file" class="form-control" id="gambar_lowongan" name="gambar_lowongan">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-4"></div>
              <div class="col-sm-8 d-flex gap-2">
                <button type="submit" class="custom-btn btn btn-primary">Simpan</button>
                <a href="{{ route('lowongankerja.index') }}" class="custom-btn btn btn-danger">Batal</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
