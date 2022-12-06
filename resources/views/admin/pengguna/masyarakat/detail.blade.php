@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="row pt-3 pb-1 mb-1">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <div class="row mb-3">
            <div class="col">
              <h2>Detail Data Pelamar</h2>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-lg-3 text-center">
              @if (is_null($orang->foto))
                <img src="{{ Avatar::create($orang->nama_lengkap) }}" alt="{{ $orang->username }}" width="170"
                  class="rounded-circle">
              @else
                <img src="{{ asset('storage/' . $orang->foto) }}" alt="{{ $orang->username }}" width="170"
                  class="rounded-circle">
              @endif
            </div>
            <div class="col-lg-9">
              <table class="table table-responsive">
                <tbody>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Username') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __($orang->username) }}</td>
                  </tr>
                  @if (!is_null($orang->email))
                    <tr>
                      <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Email') }}</td>
                      <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                      <td class="border-0 fs-5 fs-md-6">{{ __($orang->email) }}</td>
                    </tr>
                  @endif
                  @if (Hash::check('password', $orang->password))
                    <tr>
                      <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Password') }}</td>
                      <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                      <td class="border-0 fs-5 fs-md-6">
                        password
                      </td>
                    </tr>
                  @endif
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Nama Lengkap') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __($orang->nama_lengkap) }}</td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Jenis Kelamin') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">
                      @if ($orang->jenis_kelamin === 'L')
                        {{ __('Laki-laki') }}
                      @elseif ($orang->jenis_kelamin === 'P')
                        {{ __('Perempuan') }}
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Tempat Lahir') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">
                      @if (is_null($orang->tempat_lahir))
                        {{ __('Data tempat lahir pelamar tidak ada') }}
                      @else
                        {{ __($orang->tempat_lahir) }}
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Tanggal Lahir') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">
                      @if (is_null($orang->tanggal_lahir))
                        {{ __('Data tanggal lahir pelamar tidak ada') }}
                      @else
                        {{ \Carbon\Carbon::parse($orang->tanggal_lahir)->format('d M Y') }}
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('No. Telepon') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">
                      @if (is_null($orang->no_telepon))
                        {{ __('Data nomor telepon pelamar tidak ada') }}
                      @else
                        {{ __($orang->no_telepon) }}
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Alamat') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">
                      @if (is_null($orang->alamat_tempat_tinggal))
                        {{ __('Data alamat tempat tinggal pelamar tidak ada') }}
                      @else
                        {{ __($orang->alamat_tempat_tinggal) }}
                      @endif
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col">
              <a href="{{ route('admin.pelamar.index') }}" class="btn btn-danger">Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
