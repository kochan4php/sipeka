@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="row pt-3 pb-1 mb-1">
    <div class="col">
      <div class="card">
        <div class="card-header pb-0">
          <h2>Detail Lowongan Kerja</h2>
        </div>
        <div class="card-body">
          <div class="row gap-4 gap-lg-0">
            <div class="col-lg-9">
              <table class="table table-responsive">
                <tbody>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Judul Lowongan') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __($lowonganKerja->judul_lowongan) }}</td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Posisi') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __($lowonganKerja->posisi) }}</td>
                  </tr>
                  @can('admin')
                    <tr>
                      <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Nama Perusahaan') }}</td>
                      <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                      <td class="border-0 fs-5 fs-md-6">{{ __($lowonganKerja->perusahaan->nama_perusahaan) }}</td>
                    </tr>
                  @endcan
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Estimasi Gaji') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __($lowonganKerja->estimasi_gaji) }}</td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Deskripsi Lowongan') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __($lowonganKerja->deskripsi_lowongan) }}</td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Tanggal Berakhir') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">
                      @if (is_null($lowonganKerja->tanggal_berakhir))
                        {{ __('Data tanggal berakhir tidak ada') }}
                      @else
                        {{ \Carbon\Carbon::parse($lowonganKerja->tanggal_berakhir)->format('d M Y') }}
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Lokasi Kerja') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __($lowonganKerja->lokasi_kerja) }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col">
              <a href="{{ route('lowongankerja.index') }}" class="btn custom-btn btn-danger">Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
