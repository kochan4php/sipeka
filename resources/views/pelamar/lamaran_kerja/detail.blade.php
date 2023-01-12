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
            <div class="row mt-3 mb-5">
              <div class="col-12">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <button class="nav-link active">Pengumuman</button>
                  </li>
                </ul>
              </div>
              <div class="col-12 mt-3 table-responsive px-3">
                <div class="card">
                  <div class="card-header">
                    <h2>Pemberitahuan</h2>
                  </div>
                  <div class="card-body custom-font d-flex gap-2 flex-column">
                    @if (!is_null($notifikasiSeleksi))
                      <span class="fs-5">{{ $notifikasiSeleksi->pesan }}</span>
                      <span class="text-muted">Added {{ $notifikasiSeleksi->created_at->diffForHumans() }}</span>
                    @else
                      <span class="fs-5">Belum ada pemberitahuan seleksi.</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-12">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <button class="nav-link active">Daftar Tahapan Seleksi</button>
                  </li>
                </ul>
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
            <div class="row mt-3">
              <div class="col-12">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <button class="nav-link active">Penilaian Seleksi</button>
                  </li>
                </ul>
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
                          <button class="btn btn-primary btn-sm">
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

  @push('script')
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
@endsection
