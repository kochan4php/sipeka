@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="row pt-3 pb-1 mb-1">
    <div class="col">
      <div class="card">
        <div class="card-header pb-0">
          <h2>Tambah Lowongan Kerja</h2>
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
          <form action="{{ route('lowongankerja.store') }}" method="POST">
            @csrf
            <div class="mb-3 row">
              <label for="judul_lowongan" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Judul Lowongan') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="judul_lowongan" name="judul_lowongan"
                  placeholder="IT Consultant" required value="{{ old('judul_lowongan') }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="posisi" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Posisi') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="posisi" name="posisi" placeholder="Programmer" required
                  value="{{ old('posisi') }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="estimasi_gaji" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Estimasi Gaji') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="estimasi_gaji" name="estimasi_gaji"
                  placeholder="Rp. 10.000.000" required value="{{ old('estimasi_gaji') }}">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="id_jenis_pekerjaan" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Jenis Pekerjaan') }}
              </label>
              <div class="col-sm-8">
                <select name="id_jenis_pekerjaan" id="id_jenis_pekerjaan" class="form-select" required>
                  <option selected disabled hidden>-- Pilih jenis pekerjaan --</option>
                  @foreach ($jenisPekerjaan as $item)
                    <option value="{{ $item->id_jenis_pekerjaan }}">
                      {{ $item->nama_jenis_pekerjaan }}
                    </option>
                  @endforeach
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
                      <option value="{{ $item->id_kantor }}">
                        {{ $item->alamat_kantor }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
            @endcan
            @can('admin')
              <div class="mb-3 row">
                <label for="id_perusahaan" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                  {{ __('Mitra Perusahaan') }}
                </label>
                <div class="col-sm-8">
                  <select name="id_perusahaan" id="id_perusahaan" class="form-select" required>
                    <option selected disabled hidden>-- Pilih Perusahaan --</option>
                    @foreach ($perusahaan as $item)
                      <option value="{{ $item->id_perusahaan }}">
                        {{ __("{$item->jenis_perusahaan}. {$item->nama_perusahaan}") }}
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
                  rows="5"></textarea>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tanggal_berakhir" class="col-sm-4 col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Tanggal Berakhir') }}
              </label>
              <div class="col-sm-8">
                <input type="date" class="form-control" id="tanggal_berakhir" name="tanggal_berakhir"
                  placeholder="28/12/2022" value="{{ old('tanggal_berakhir') }}">
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
                <button type="submit" class="btn custom-btn btn-primary">Tambah</button>
                <a href="{{ route('lowongankerja.index') }}" class="btn custom-btn btn-danger">Batal</a>
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
    const dengan_rupiah = document.getElementById('estimasi_gaji');
    dengan_rupiah.addEventListener('keyup', function(e) {
      dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi */
    function formatRupiah(angka, prefix) {
      let number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
  </script>
@endpush
