@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="pt-3 pb-1 mb-2">
    <h3 class="text-center">
      {{ __("Tahapan Seleksi Lowongan {$lowonganKerja->judul_lowongan}") }}
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
              <th scope="col" class="text-nowrap text-center">Nama Tahapan</th>
              <th scope="col" class="text-nowrap text-center">Urutan Tahapan</th>
              <th scope="col" class="text-nowrap text-center">Tanggal Dimulai</th>
              <th scope="col" class="text-nowrap text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($lowonganKerja->tahapan_seleksi as $tahapan)
              <tr>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $loop->iteration }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $tahapan->judul_tahapan }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $tahapan->urutan_tahapan_ke }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $tahapan->tanggal_dimulai }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  <div>
                    <a href="{{ route('lowongankerja.applicant-selection', [
                        'lowongan_kerja' => $lowonganKerja->slug,
                        'tahapan_seleksi' => $tahapan->id_tahapan,
                    ]) }}"
                      class="btn btn-primary custom-btn @if ($tahapan->status === 'Menunggu Persetujuan Admin' || $tahapan->status === 'Selesai') disabled @endif">
                      @if ($tahapan->status === 'Menunggu Persetujuan Admin' || $tahapan->status === 'Selesai')
                        {{ __($tahapan->status) }}
                      @elseif($tahapan->status === 'Ditolak')
                        {{ __('Seleksi Ulang') }}
                      @else
                        {{ __('Seleksi Pendaftar') }}
                      @endif
                    </a>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-nowrap text-center vertical-align-middle custom-font">
                  Lowongan ini belum memiliki tahapan seleksi
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
