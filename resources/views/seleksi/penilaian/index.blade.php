@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
    <h3>Data Lamaran Kerja</h3>
  </div>

  <x-alert-session />

  <div class="row">
    <div class="col table-responsive">
      <div class="table-responsive pb-2">
        <table @if ($pendaftaranLowongan->count() > 0) id="myTable" @endif
          class="table table-bordered border-secondary table-striped py-2">
          <thead class="table-dark">
            <tr>
              <th scope="col" class="text-nowrap text-center vertical-align-middle">No</th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle">Lowongan Yang Dilamar</th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle">Nama Perusahaan</th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle">Nama Pelamar</th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle">Alumni / Kandidat Luar</th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle">
                <span>Kelengkapan Dokumen</span>
                <span>
                  <button type="button" class="text-white text-decoration-none p-2 bg-transparent border-0"
                    data-bs-toggle="modal" data-bs-target="#modalPetunjuk">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                      class="bi bi-question-circle" viewBox="0 0 16 16">
                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                      <path
                        d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                    </svg>
                  </button>
                </span>
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle">Status Seleksi</th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle">Status Verifikasi</th>
              @canany(['admin', 'perusahaan'])
                <th scope="col" class="text-nowrap text-center vertical-align-middle">Aksi</th>
              @endcanany
            </tr>
          </thead>
          <tbody>
            @forelse ($pendaftaranLowongan as $item)
              @php
                $namaPelamar = '';
                
                if (!is_null($item->pelamar->alumni)):
                    $namaPelamar = $item->pelamar->alumni->nama_lengkap;
                else:
                    $namaPelamar = $item->pelamar->masyarakat->nama_lengkap;
                endif;
              @endphp

              <tr>
                <th class="text-nowrap text-center vertical-align-middle custom-font" scope="row">
                  {{ $loop->iteration }}.
                </th>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->lowongan->judul_lowongan }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->lowongan->perusahaan->nama_perusahaan }}
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
                <td class="text-nowrap vertical-align-middle custom-font">
                  <div class="d-flex flex-column gap-2">
                    @foreach ($jenisDokumen as $jd)
                      <div>
                        <span>{{ $jd->nama_dokumen }}</span>
                        @foreach ($item->pelamar->dokumen as $dokumenPelamar)
                          @if ($dokumenPelamar->id_jenis_dokumen === $jd->id_jenis_dokumen)
                            <span>
                              <i class="fa-solid fa-check fa-lg text-success"></i>
                            </span>
                          @endif
                        @endforeach
                      </div>
                    @endforeach
                  </div>
                </td>
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
                  <td class="text-nowrap vertical-align-middle custom-font">
                    <form action="{{ route('pendaftaran_lowongan.verifikasi', $item->id_pendaftaran) }}" method="post">
                      <div class="d-flex gap-2">
                        @csrf
                        <button type="submit" name="verification" value="true" class="btn custom-btn btn-warning"
                          @disabled($item->verifikasi !== 'Belum' || $item->verifikasi === 'Sudah')>
                          <i class="fa-solid fa-square-check fa-lg"></i>
                        </button>
                        <a href="" class="btn custom-btn btn-info">
                          <i class="fa-solid fa-file-pdf fa-lg"></i>
                        </a>
                        <a href="{{ route('penilaian.seleksi.job_application_details', $item->id_pendaftaran) }}"
                          class="btn custom-btn btn-primary">
                          <i class="fa-solid fa-info-circle fa-lg"></i>
                        </a>
                        <a href="{{ route('notifikasi.seleksi.index', $item->pelamar->id_pelamar) }}"
                          class="btn custom-btn btn-success btn-notif">
                          <i class="fa-solid fa-envelope fa-lg"></i>
                        </a>
                      </div>
                    </form>
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

  <x-modal-petunjuk-dokumen>
    Jika pada kolom Kelengkapan Dokumen terdapat icon centang hijau &#40; <span>
      <i class="fa-solid fa-check fa-lg text-success"></i>
    </span>&#41;&#791; artinya pelamar sudah mengupload dokumen tersebut. Dan sebaliknya, jika tidak terdapat icon centang
    hijau &#40; <span>
      <i class="fa-solid fa-check fa-lg text-success"></i>
    </span>&#41;&#791; pada kolom Kelengkapan Dokumen, maka pelamar tersebut belum mengupload jenis dokumen tersebut.
  </x-modal-petunjuk-dokumen>
@endsection
