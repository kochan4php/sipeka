@extends('layouts.dashboard.app')

@push('style')
  <style>
    .nilai,
    .keterangan {
      width: 100%;
    }

    @media screen and (max-width: 1024px) {

      .nilai,
      .keterangan {
        width: 200px;
      }
    }
  </style>
@endpush

@section('container-dashboard')
  <div class="pt-3 pb-1 mb-2">
    <h3 class="text-center">
      {{ __("Seleksi {$tahapanSeleksi->judul_tahapan}") }}
    </h3>
  </div>

  <x-alert-error-validation />

  <div class="alert alert-info custom-font">
    <div class="row">
      <div class="col">
        <strong>{{ __('Cara memberikan penilaian!') }}</strong>
      </div>
    </div>
    <div class="row">
      <div class="col">
        {{ __('1. Nilai yang dimasukkan harus berada di rentang 1 - 100.') }}
      </div>
    </div>
    <div class="row">
      <div class="col">
        {{ __('2. Jika nilai yang diberikan berada di bawah 80, maka sistem secara otomatis membuat pendaftar tidak lulus / gagal.') }}
      </div>
    </div>
    <div class="row">
      <div class="col">
        {{ __('3. Jika kolom Status Lulus tidak diclick, maka pendaftar otomatis tidak lulus tahap seleksi.') }}
      </div>
    </div>
  </div>

  <form
    action="{{ route('lowongankerja.applicant-selection.store', [
        'lowongan_kerja' => $lowonganKerja->slug,
        'tahapan_seleksi' => $tahapanSeleksi->id_tahapan,
    ]) }}"
    method="post">
    @csrf
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
                <th scope="col" class="text-nowrap text-center">Nilai</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($pendaftaranLowongan as $key => $item)
                @php
                  $currentStage = $item
                      ->penilaian_seleksi()
                      ->currentStage($tahapanSeleksi->id_tahapan)
                      ->first();
                @endphp
                <input type="hidden" name="id_pendaftaran[]" value="{{ $item->id_pendaftaran }}">
                <input type="hidden" name="id_pelamar[]" value="{{ $item->id_pelamar }}">
                {{-- @if (!is_null($currentStage?->id_penilaian_seleksi)) --}}
                <input type="hidden" name="id_penilaian_seleksi[]" value="{{ $currentStage?->id_penilaian_seleksi }}">
                {{-- @endif --}}
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
                    <input type="number" class="form-control nilai" name="nilai[]" max="100" min="1" required
                      value="{{ $currentStage?->nilai }}">
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-nowrap text-center vertical-align-middle custom-font">
                    Belum ada yang mendaftar di loker ini.
                  </td>
                </tr>
              @endforelse
              @if (!$pendaftaranLowongan->isEmpty())
                <tr>
                  <td colspan="7" class="text-nowrap text-center vertical-align-middle custom-font">
                    <button type="submit" class="btn btn-success custom-btn w-100">
                      {{ __('Simpan') }}
                    </button>
                  </td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </form>

  <div>
    <a href="{{ route('lowongankerja.see-stages', $lowonganKerja->slug) }}" class="btn btn-primary custom-btn mt-3">
      Kembali
    </a>
  </div>
@endsection

@push('script')
  <script>
    const nilai = document.querySelectorAll('.nilai');
    nilai.forEach(item => {
      item.addEventListener('keyup', function() {
        const select = this.parentElement.nextElementSibling.firstElementChild;
        if (this.value < 80) select.value = 'Tidak';
        else select.value = 'Lulus'
      });
    });
  </script>
@endpush
