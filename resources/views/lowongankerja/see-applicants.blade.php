@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="pt-3 pb-1 mb-2">
    <h3 class="text-center">
      {{ __("Pendaftar di lowongan {$lowonganKerja->judul_lowongan}") }}
    </h3>
  </div>

  <x-alert-session />

  <div class="row">
    <div class="col table-responsive">
      <div class="table-responsive pb-2">
        <table class="table table-bordered border-secondary table-striped py-2">
          <thead class="table-dark">
            <tr>
              <th scope="col" class="text-nowrap text-center">No</th>
              <th scope="col" class="text-nowrap text-center">Nama Pendaftar</th>
              <th scope="col" class="text-nowrap text-center">Alumni / Kandidat Luar Sekolah</th>
              <th scope="col" class="text-nowrap text-center">Email</th>
              <th scope="col" class="text-nowrap text-center">{{ __('No. Telp') }}</th>
              <th scope="col" class="text-nowrap text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($pendaftaranLowongan as $key => $item)
              <tr>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $pendaftaranLowongan->firstItem() + $key }}
                </td>
                @if ($item->pelamar->alumni)
                  <td class="text-nowrap text-center vertical-align-middle custom-font">
                    {{ $item->pelamar->alumni->nama_lengkap }}
                  </td>
                  <td class="text-nowrap text-center vertical-align-middle custom-font">
                    Alumni
                  </td>
                @else
                  <td class="text-nowrap text-center vertical-align-middle custom-font">
                    {{ $item->pelamar->masyarakat->nama_lengkap }}
                  </td>
                  <td class="text-nowrap text-center vertical-align-middle custom-font">
                    Kandidat Luar Sekolah
                  </td>
                @endif
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->pelamar->user->email ?? __('-') }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->pelamar->user->email ?? __('-') }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">

                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-nowrap text-center vertical-align-middle custom-font">
                  Belum ada yang mendaftar di loker ini.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div>
    <a href="{{ route('lowongankerja.detail', $lowonganKerja->slug) }}" class="btn btn-primary custom-btn">
      Kembali
    </a>
  </div>
@endsection
