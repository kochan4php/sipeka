@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
    <h3>Data Lamaran Kerja</h3>
  </div>

  <x-alert-session />

  <div class="row">
    <div class="col table-responsive">
      <div class="table-responsive pb-2">
        <table class="table table-bordered border-secondary border-1 table-striped mb-0">
          <thead class="table-dark">
            <tr>
              <th scope="col" class="text-nowrap text-center">No</th>
              <th scope="col" class="text-nowrap text-center">Lowongan Yang Dilamar</th>
              <th scope="col" class="text-nowrap text-center">Nama Pelamar</th>
              <th scope="col" class="text-nowrap text-center">Alumni / Kandidat Luar</th>
              <th scope="col" class="text-nowrap text-center">Status Seleksi</th>
              <th scope="col" class="text-nowrap text-center">Status Verifikasi</th>
              @canany(['admin', 'perusahaan'])
                <th scope="col" class="text-nowrap text-center">Aksi</th>
              @endcanany
            </tr>
          </thead>
          <tbody>
            @forelse ($pendaftaranLowongan as $item)
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
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  <div class="d-flex gap-2 justify-content-center align-items-center">
                    @if ($item->status_seleksi === 'Lulus')
                      <span>
                        <i class="fa-solid fa-check fa-lg text-success"></i>
                      </span>
                    @else
                      <span>
                        <i class="fa-solid fa-xmark fa-lg text-danger"></i>
                      </span>
                    @endif
                    <span>{{ $item->status_seleksi }}</span>
                  </div>
                </td>
                @can('admin')
                  <td class="text-nowrap text-center vertical-align-middle custom-font">
                    <div class="d-flex gap-2 justify-content-center align-items-center">
                      @if ($item->verifikasi === 'Sudah')
                        <span>
                          <i class="fa-solid fa-check fa-lg text-success"></i>
                        </span>
                      @else
                        <span>
                          <i class="fa-solid fa-xmark fa-lg text-danger"></i>
                        </span>
                      @endif
                      <span>{{ $item->verifikasi }}</span>
                    </div>
                  </td>
                  <td
                    class="text-nowrap d-flex justify-content-center gap-2 align-items-center vertical-align-middle custom-font">
                    <form action="{{ route('pendaftaran_lowongan.verifikasi', $item->id_pendaftaran) }}" method="post">
                      @csrf
                      <button type="submit" name="verification" value="true" class="btn btn-warning custom-btn"
                        @disabled($item->verifikasi !== 'Belum' || $item->verifikasi === 'Sudah')>
                        <i class="fa-solid fa-square-check fa-lg"></i>
                      </button>
                    </form>
                    <a href="" class="btn btn-info custom-btn">
                      <i class="fa-solid fa-file-pdf fa-lg"></i>
                    </a>
                    <a href="{{ route('penilaian.seleksi.job_application_details', $item->id_pendaftaran) }}"
                      class="btn btn-primary custom-btn @if ($item->verifikasi !== 'Sudah' || $item->verifikasi === 'Belum') disabled @endif">
                      <i class="fa-solid fa-info-circle fa-lg"></i>
                    </a>
                  </td>
                @endcan
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-nowrap text-center vertical-align-middle custom-font">
                  Belum ada pelamar yang melamar lowongan saat ini.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
