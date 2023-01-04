@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="row pt-3 pb-1 mb-1">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <div class="row mb-3">
            <div class="col">
              <h2>Detail Data Kandidat Luar Sekolah</h2>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-lg-3 text-center">
              @if (is_null($kandidat_luar->foto))
                <img src="{{ Avatar::create($kandidat_luar->nama_lengkap) }}" alt="{{ $kandidat_luar->username }}"
                  width="170" class="rounded-circle">
              @else
                <img src="{{ asset('storage/' . $kandidat_luar->foto) }}" alt="{{ $kandidat_luar->username }}"
                  width="170">
              @endif
            </div>
            <div class="col-lg-9">
              <table class="table table-responsive">
                <tbody>
                  @if (!is_null($kandidat_luar->pelamar->user->email))
                    <tr>
                      <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Email') }}</td>
                      <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                      <td class="border-0 fs-5 fs-md-6">{{ __($kandidat_luar->pelamar->user->email) }}</td>
                    </tr>
                  @endif
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Nama Lengkap') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __($kandidat_luar->nama_lengkap) }}</td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Jenis Kelamin') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">
                      @if ($kandidat_luar->jenis_kelamin === 'L')
                        {{ __('Laki-laki') }}
                      @elseif ($kandidat_luar->jenis_kelamin === 'P')
                        {{ __('Perempuan') }}
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Tempat Lahir') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">
                      @if (is_null($kandidat_luar->tempat_lahir))
                        {{ __('Data tempat lahir pelamar tidak ada') }}
                      @else
                        {{ __($kandidat_luar->tempat_lahir) }}
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Tanggal Lahir') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">
                      @if (is_null($kandidat_luar->tanggal_lahir))
                        {{ __('Data tanggal lahir pelamar tidak ada') }}
                      @else
                        {{ \Carbon\Carbon::parse($kandidat_luar->tanggal_lahir)->format('d M Y') }}
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('No. Telepon') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">
                      @if (is_null($kandidat_luar->no_telepon))
                        {{ __('Data nomor telepon pelamar tidak ada') }}
                      @else
                        {{ __($kandidat_luar->no_telepon) }}
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Alamat') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">
                      @if (is_null($kandidat_luar->alamat_tempat_tinggal))
                        {{ __('Data alamat tempat tinggal pelamar tidak ada') }}
                      @else
                        {{ __($kandidat_luar->alamat_tempat_tinggal) }}
                      @endif
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col">
              <a href="{{ route('perusahaan.pelamar.index') }}" class="btn btn-danger custom-btn">Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
