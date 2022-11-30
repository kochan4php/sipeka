@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="row pt-3 pb-1 mb-1">
    <div class="col">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row mb-2">
            <div class="col">
              <h2>Detail Data Perusahaan</h2>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <div class="col">
              <img src="{{ asset('assets/images/no-photo.png') }}" class="img-fluid" alt="Foto Sampul Perusahaan">
            </div>
          </div>
          <hr />
          <div class="row my-4">
            <div class="col-lg-3 text-center mb-4 mb-lg-0">
              <img
                src="{{ Avatar::create($perusahaan->email)->toGravatar(['d' => 'identicon', 'r' => 'pg', 's' => 1000]) }}"
                alt="{{ $perusahaan->username }}" class="rounded-circle border border-secondary" width="170">
            </div>
            <div class="col-lg-9">
              <table class="table table-responsive">
                <tbody>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Nama Perusahaan') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __($perusahaan->nama_perusahaan) }}</td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Email Perusahaan') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __($perusahaan->email) }}</td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Username') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __($perusahaan->username) }}</td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Password') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">
                      @if (Hash::check('perusahaan', $perusahaan->password))
                        perusahaan
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('No. Telepon / Fax') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __($perusahaan->nomor_telp_perusahaan) }}</td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Deskripsi') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">
                      {!! $perusahaan->deskripsi_perusahaan ?? 'Belum ada deskripsi perusahaan' !!}
                    </td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Alamat') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">
                      {{ __($perusahaan->alamat_perusahaan) }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col">
              <a href="{{ route('admin.perusahaan.index') }}" class="btn btn-danger">Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
