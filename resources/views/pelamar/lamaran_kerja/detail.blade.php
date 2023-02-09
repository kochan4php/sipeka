@extends('layouts.app')

@section('container')
  <div class="container mb-5" style="margin-top: 120px;">
    <div class="row gap-4 gap-md-0">
      @include('pelamar.action')
      <div class="col-lg-9">
        <div class="card rounded shadow">
          <div class="card-header d-flex align-items-center justify-content-between pb-0">
            <h4>Detail Progress Pendaftaran</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col d-flex gap-3">
                <div>
                  <img src="{{ asset('assets/images/7.jpeg') }}" width="60" alt="image" class="img-thumbnail">
                </div>
                <div>
                  <h4>{{ $pendaftaranLowongan->lowongan->judul_lowongan }}</h4>
                  <h5>{{ __("Status Lulus : {$pendaftaranLowongan->status_seleksi}") }}</h5>
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col">
                <p class="text-muted">
                  {{ $pendaftaranLowongan->lowongan->perusahaan->nama_perusahaan }}
                </p>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <ul class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link custom-font active" id="tahapan-seleksi-tab" data-bs-toggle="pill"
                      data-bs-target="#tahapan-seleksi" type="button" role="tab" aria-controls="tahapan-seleksi"
                      aria-selected="true">Tahapan
                      Seleksi</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link custom-font" id="penilaian-tab" data-bs-toggle="pill"
                      data-bs-target="#penilaian" type="button" role="tab" aria-controls="penilaian"
                      aria-selected="false">Penilaian</button>
                  </li>
                </ul>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="tahapan-seleksi" role="tabpanel"
                    aria-labelledby="tahapan-seleksi-tab" tabindex="0">
                    <div class="row mt-3 mb-4">
                      <div class="col-12">
                        <h3>Tahapan Seleksi</h3>
                      </div>
                      <div class="col-12 mt-3 table-responsive">
                        <table class="table table-bordered border-secondary border-1 table-striped mb-0">
                          <thead class="table-dark">
                            <tr>
                              <th scope="col" class="text-nowrap text-center">No</th>
                              <th scope="col" class="text-nowrap text-center">Judul Tahapan</th>
                              <th scope="col" class="text-nowrap text-center">Keterangan Tahapan</th>
                              <th scope="col" class="text-nowrap text-center">Status Tahapan</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($pendaftaranLowongan->lowongan->tahapan_seleksi as $item)
                              <tr>
                                <th class="text-nowrap text-center vertical-align-middle custom-font">
                                  {{ $loop->iteration }}
                                </th>
                                <td class="text-nowrap text-center vertical-align-middle custom-font">
                                  {{ $item->judul_tahapan }}
                                </td>
                                <td class="text-nowrap text-center vertical-align-middle custom-font">
                                  {{ $item->ket_tahapan }}
                                </td>
                                @if ($penilaianSeleksi->firstWhere('id_tahapan', $item->id_tahapan)?->is_lanjut === 'Ya')
                                  <td class="text-nowrap text-center vertical-align-middle custom-font  checked-tahapan">
                                    <i class="fa-solid fa-check fa-lg text-success"></i>
                                  </td>
                                @else
                                  <td class="text-nowrap text-center vertical-align-middle custom-font xmark-tahapan">
                                    <i class="fa-solid fa-xmark fa-lg text-danger"></i>
                                  </td>
                                @endif
                              </tr>
                            @empty
                              <tr>
                                <td colspan="4" class="text-nowrap text-center vertical-align-middle custom-font">
                                  Belum ada tahapan seleksi untuk lowongan ini. Silahkan hubungi admin segera!
                                </td>
                              </tr>
                            @endforelse
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="penilaian" role="tabpanel" aria-labelledby="penilaian-tab"
                    tabindex="0">
                    <div class="row mt-3 mb-4">
                      <div class="col-12">
                        <h3>Penilaian</h3>
                      </div>
                      <div class="col-12 mt-3 table-responsive">
                        <table class="table table-bordered border-secondary border-1 table-striped mb-0">
                          <thead class="table-dark">
                            <tr>
                              <th scope="col" class="text-nowrap">No</th>
                              <th scope="col" class="text-nowrap">Tahapan</th>
                              <th scope="col" class="text-nowrap">Status</th>
                              <th scope="col" class="text-nowrap">Nilai</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th class="text-nowrap vertical-align-middle custom-font">
                                1
                              </th>
                              <td class="text-nowrap vertical-align-middle custom-font">
                                Verifikasi
                              </td>
                              <td class="text-nowrap vertical-align-middle custom-font d-flex flex-column gap-1 ">
                                <span>
                                  {{ __("{$pendaftaranLowongan->verifikasi} verifikasi") }}
                                </span>
                                <span>
                                  <button type="button" data-username="{{ Auth::user()->username }}"
                                    data-id-pendaftaran="{{ $pendaftaranLowongan->id_pendaftaran }}"
                                    class="btn btn-primary btn-sm btn-print-verifikasi">
                                    <i class="fa-solid fa-print"></i>
                                  </button>
                                </span>
                              </td>
                              <td class="text-nowrap vertical-align-middle custom-font">
                                {{ __('-') }}
                              </td>
                            </tr>
                            @foreach ($penilaianSeleksi as $item)
                              <tr>
                                <th class="text-nowrap vertical-align-middle custom-font">
                                  {{ $loop->iteration + 1 }}
                                </th>
                                <td class="text-nowrap vertical-align-middle custom-font">
                                  {{ $item->tahapan->judul_tahapan }}
                                </td>
                                <td class="text-nowrap vertical-align-middle custom-font">
                                  {{ __("{$item->keterangan} tahapan seleksi") }}
                                </td>
                                <td class="text-nowrap vertical-align-middle custom-font">
                                  {{ $item->nilai }}
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('script')
  <script>
    const btnPrintVerifikasi = document.querySelector('.btn-print-verifikasi');
    const username = btnPrintVerifikasi.dataset.username;
    const idPendaftaran = btnPrintVerifikasi.dataset.idPendaftaran;
    const url =
      (
        `{{ route('pelamar.lamaran.pdf-verifikasi', ['username' => ':username', 'pendaftaran_lowongan' => ':idPendaftaran']) }}`
      )
      .replace(':username', username)
      .replace(':idPendaftaran', idPendaftaran);

    btnPrintVerifikasi.addEventListener('click', () => printExternal(url));

    function printExternal(url) {
      const printWindow = window.open(url, '_blank', 'resizable=0');

      printWindow.addEventListener('load', function() {
        if (Boolean(printWindow.chrome)) {
          printWindow.print();
          setTimeout(function() {
            printWindow.close();
          }, 500);
        } else {
          printWindow.print();
          printWindow.close();
        }
      }, true);
    }
  </script>
  <script>
    tippy('.checked-tahapan', {
      content: 'Tuntas',
      placement: 'left'
    });
    tippy('.xmark-tahapan', {
      content: 'Belum Tuntas',
      placement: 'left'
    });
  </script>
@endpush
