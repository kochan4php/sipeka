@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
    <h1>Data Lamaran Kerja</h1>
  </div>

  <x-alert-session />

  <div class="row">
    <div class="col table-responsive">
      <div class="table-responsive pb-2">
        <table class="table table-bordered border-secondary border-1 table-striped mb-0">
          <thead class="table-dark">
            <tr>
              <th scope="col" class="text-nowrap text-center">No</th>
              <th scope="col" class="text-nowrap text-center">Judul Lowongan</th>
              <th scope="col" class="text-nowrap text-center">Nama Pelamar</th>
              <th scope="col" class="text-nowrap text-center">Alumni / Kandidat Luar</th>
              <th scope="col" class="text-nowrap text-center">Status Verifikasi</th>
              <th scope="col" class="text-nowrap text-center">Lakukan Verifikasi</th>
              @canany(['admin', 'perusahaan'])
                <th scope="col" class="text-nowrap text-center">Aksi</th>
              @endcanany
            </tr>
          </thead>
          <tbody>
            @foreach ($lamaranKerja as $item)
              <tr>
                <th class="text-nowrap text-center vertical-align-middle custom-font" scope="row">
                  {{ $loop->iteration }}.
                </th>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->lowongan->judul_lowongan }}
                </td>
                @if (!is_null($item->pelamar->alumni))
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
                    Kandidat Luar
                  </td>
                @endif
                @can('admin')
                  <td class="text-nowrap text-center vertical-align-middle custom-font">
                    {{ $item->verifikasi }}
                  </td>
                  <td
                    class="text-nowrap d-flex justify-content-center gap-2 align-items-center vertical-align-middle custom-font">
                    <form action="{{ route('pendaftaran_lowongan.verifikasi', $item->id_pendaftaran) }}" method="post">
                      @csrf
                      <button type="submit" name="verification" value="true"
                        class="btn btn-warning fw-semibold custom-btn d-flex align-items-center gap-2"
                        @disabled($item->verifikasi !== 'Belum' || $item->verifikasi === 'Sudah')>
                        <i class="fa-solid fa-square-check fa-lg"></i>
                        <span>Verifikasi Pendaftaran</span>
                      </button>
                    </form>
                    <a href="" class="btn btn-info fw-semibold custom-btn d-flex align-items-center gap-2">
                      <i class="fa-solid fa-file-pdf fa-lg"></i>
                      <span>Bukti Pendaftaran</span>
                    </a>
                  </td>
                @endcan
                @canany(['admin', 'perusahaan'])
                  <td class="text-nowrap text-center vertical-align-middle">
                    <a href="{{ route('tahapan.seleksi.jobApplicationDetails', $item->id_pendaftaran) }}"
                      class="btn btn-primary custom-btn fw-semibold @if ($item->verifikasi === 'Belum') disabled cursor-not-allowed @endif"
                      style="font-size: 0.9rem">
                      Detail Lamaran Kerja
                    </a>
                  </td>
                @endcanany
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
