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
          <form action="{{ route('lowongankerja.update', $lowongan->slug) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3 row">
              <label for="judul_lowongan" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Judul Lowongan') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="judul_lowongan" name="judul_lowongan"
                  placeholder="IT Consultant" required value="{{ old('judul_lowongan', $lowongan->judul_lowongan) }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="posisi" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Posisi') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="posisi" name="posisi" placeholder="Programmer" required
                  value="{{ old('posisi', $lowongan->posisi) }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="estimasi_gaji" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Estimasi Gaji') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="estimasi_gaji" name="estimasi_gaji"
                  placeholder="Rp. 10.000.000" required value="{{ old('estimasi_gaji', $lowongan->estimasi_gaji) }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="id_jenis_pekerjaan" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Jenis Pekerjaan') }}
              </label>
              <div class="col-sm-8">
                <select name="jenis_pekerjaan" id="jenis_pekerjaan" class="form-select jenis_pekerjaan" required>
                  <option selected disabled hidden>-- Pilih jenis pekerjaan --</option>
                  <option value="Full-time" @checked($lowongan->jenis_pekerjaan === 'Full-time')>
                    Full-time
                  </option>
                  <option value="Part-time" @checked($lowongan->jenis_pekerjaan === 'Part-time')>
                    Part-time
                  </option>
                  <option value="Freelance" @checked($lowongan->jenis_pekerjaan === 'Freelance')>
                    Freelance
                  </option>
                  <option value="Contract" @checked($lowongan->jenis_pekerjaan === 'Contract')>
                    Contract
                  </option>
                  <option value="Internship" @checked($lowongan->jenis_pekerjaan === 'Internship')>
                    Internship
                  </option>
                </select>
              </div>
            </div>
            @can('perusahaan')
              <div class="mb-3 row">
                <label for="lokasi_kerja" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                  {{ __('Lokasi Kerja') }}
                </label>
                <div class="col-sm-8">
                  <select name="lokasi_kerja" id="lokasi_kerja" class="form-select" required>
                    <option selected disabled hidden>-- Pilih Lokasi Kerja --</option>
                    @foreach (Auth::user()->perusahaan->kantor as $item)
                      <option value="{{ $item->id_kantor }}" @checked($item->id_kantor === $lowongan->lokasi_kerja)>
                        {{ $item->alamat_kantor }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
            @endcan
            @can('admin')
              <div class="mb-3 row">
                <label for="lokasi_kerja" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                  {{ __('Lokasi Kerja') }}
                </label>
                <div class="col-sm-8">
                  <select name="lokasi_kerja" id="lokasi_kerja" class="form-select" required>
                    <option hidden selected disabled>-- Pilih Lokasi Kerja --</option>
                    @foreach ($lowongan->perusahaan->kantor as $item)
                      <option value="{{ $item->id_kantor }}" @selected($item->id_kantor === $lowongan->kantor->id_kantor)>
                        {{ __("{$item->alamat_kantor} - {$item->wilayah_kantor} - {$item->status_kantor}") }}
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
                  rows="5">
                {{ old('deskripsi_lowongan', $lowongan->deskripsi_lowongan) }}
                </textarea>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tanggal_berakhir" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Tanggal Berakhir') }}
              </label>
              <div class="col-sm-8">
                <input type="date" class="form-control" id="tanggal_berakhir" name="tanggal_berakhir"
                  placeholder="28/12/2022" value="{{ old('tanggal_berakhir', $lowongan->tanggal_berakhir) }}">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4"></div>
              <div class="col-sm-8">
                <img class="d-block image-preview rounded @if (!is_null($lowongan->banner)) mb-3 @endif"
                  @if (!is_null($lowongan->banner)) src="{{ $lowongan->banner }}" @endif width="300">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="banner_loker" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Banner') }}
              </label>
              <div class="col-sm-8">
                <input type="file" class="form-control" id="banner_loker" name="banner">
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

@push('script')
  <script type="text/javascript" src="{{ asset('assets/js/ckeditor_init.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/format_rupiah.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/preview_image.js') }}"></script>
  <script>
    CKEDITOR_INIT('deskripsi');
    formatRupiah('estimasi_gaji');
    previewImage('banner_loker', 'image-preview');
  </script>
@endpush
