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
              <img src="{{ Avatar::create($masyarakat->nama_lengkap) }}" alt="{{ $masyarakat->username }}" width="200"
                class="rounded-circle">
            </div>
            <div class="col-lg-9">
              <table class="table table-responsive">
                <tbody>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Username') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __($masyarakat->username) }}</td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Password') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">
                      @if (Hash::check('password', $masyarakat->password))
                        password
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Nama Lengkap') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __($masyarakat->nama_lengkap) }}</td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Jenis Kelamin') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">
                      @if ($masyarakat->jenis_kelamin === 'L')
                        {{ __('Laki-laki') }}
                      @elseif ($masyarakat->jenis_kelamin === 'P')
                        {{ __('Perempuan') }}
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Tempat Lahir') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">
                      @if (is_null($masyarakat->tempat_lahir))
                        {{ __('Data tempat lahir pelamar tidak ada') }}
                      @else
                        {{ __($masyarakat->tempat_lahir) }}
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Tanggal Lahir') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">
                      @if (is_null($masyarakat->tanggal_lahir))
                        {{ __('Data tanggal lahir pelamar tidak ada') }}
                      @else
                        {{ \Carbon\Carbon::parse($masyarakat->tanggal_lahir)->format('d M Y') }}
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('No. Telepon') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">
                      @if (is_null($masyarakat->no_telepon))
                        {{ __('Data nomor telepon pelamar tidak ada') }}
                      @else
                        {{ __($masyarakat->no_telepon) }}
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td class="border-0 fs-5 fs-md-6 text-nowrap">{{ __('Alamat') }}</td>
                    <td class="border-0 fs-5 fs-md-6">{{ __(':') }}</td>
                    <td class="border-0 fs-5 fs-md-6">
                      @if (is_null($masyarakat->alamat_tempat_tinggal))
                        {{ __('Data alamat tempat tinggal pelamar tidak ada') }}
                      @else
                        {{ __($masyarakat->alamat_tempat_tinggal) }}
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
