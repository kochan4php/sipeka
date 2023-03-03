@extends('layouts.app')

@push('head')
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
  <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
@endpush

@push('style')
  <style>
    .mainlayout {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      align-items: center;
    }
  </style>
@endpush

@section('container')
  <div class="container my-5 pt-5">
    <x-alert-error-validation />
    <div class="row gap-3 gap-lg-0">
      <div class="col-lg-7">
        <div class="card">
          <div class="card-body">
            <div class="mb-3">
              <img src="{{ $lowonganKerja->banner ? $lowonganKerja->banner : asset('assets/images/no-photo.png') }}"
                class="img-fluid w-100 rounded" alt="{{ $lowonganKerja->perusahaan->nama_perusahaan }}" draggable="false">
            </div>

            <div class="mb-4 text-center">
              <h1>{{ $lowonganKerja->judul_lowongan }}</h1>
              <h5 class="fst-italic">
                {{ $lowonganKerja->perusahaan->nama_perusahaan }}
              </h5>
            </div>

            <div class="row">
              <div class="col-lg-6">
                <div class="card mb-3">
                  <div class="card-body pb-0">
                    <div class="card-title">
                      <h4 class="fw-semibold">Posisi</h4>
                    </div>
                    <div class="mb-4 custom-font">
                      {{ $lowonganKerja->posisi }}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card mb-3">
                  <div class="card-body pb-0">
                    <div>
                      <h4 class="fw-semibold">Estimasi Gaji</h4>
                    </div>
                    <div class="mb-4 custom-font">
                      {{ $lowonganKerja->estimasi_gaji }}
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="card mb-3">
                  <div class="card-body pb-0">
                    <div>
                      <h4 class="fw-semibold">Wilayah Kantor</h4>
                    </div>
                    <div class="mb-4 custom-font">
                      {{ $lowonganKerja->kantor->wilayah_kantor }}
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="card mb-3">
                  <div class="card-body pb-0">
                    <div>
                      <h4 class="fw-semibold">Alamat Kantor</h4>
                    </div>
                    <div class="mb-4 custom-font">
                      {{ $lowonganKerja->kantor->alamat_kantor }}
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="card mb-3">
                  <div class="card-body pb-0">
                    <div>
                      <h4 class="fw-semibold">Deskripsi Pekerjaan</h4>
                    </div>
                    <div class="mb-4 custom-font">
                      {!! $lowonganKerja->deskripsi_lowongan !!}
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="card mb-3">
                  <div class="card-body pb-0">
                    <div>
                      <h4 class="fw-semibold">Deskripsi Perusahaan</h4>
                    </div>
                    <div class="mb-4 custom-font">
                      {!! $lowonganKerja->perusahaan->deskripsi_perusahaan ?? 'Perusahaan ini belum memiliki deskripsi' !!}
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="mb-5 mt-4">
              <hr>
            </div>

            <div class="card mb-3">
              <div class="card-body pb-0">
                <div class="mb-3">
                  <h4 class="fw-semibold text-center">
                    <span>Tahapan Seleksi</span>
                    <span>{{ __("({$lowonganKerja->tahapan_seleksi->count()})") }}</span>
                  </h4>
                </div>
                <div class="mb-4 custom-font">
                  @foreach ($lowonganKerja->tahapan_seleksi as $item)
                    <div class="col-12 mb-3">
                      <div class="card">
                        <div class="card-body pb-0">
                          <p class="fw-bold mb-0">{{ __('- Nama Tahap') }}</p>
                          <p class="mb-0 nama-tahap">{{ $item->judul_tahapan }}</p>
                          <div class="my-2">
                            <p class="mb-0 fw-bold text-break">{{ __('- Keterangan') }}</p>
                            <p class="text-break" style="font-size: 16px;">{{ $item->ket_tahapan }}</p>
                          </div>
                        </div>
                        <div class="card-footer">
                          <span>Dilaksanankan pada</span>
                          <strong>{{ \Carbon\Carbon::parse($item->tanggal_dimulai)->format('d F Y') }}</strong>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>

            @can('pelamar')
              <div class="d-flex gap-2 w-100">
                <a href="{{ route('admin.perusahaan.edit', '') }}"
                  class="btn custom-btn d-flex gap-2 align-items-center justify-content-center leading-1px btn-info">
                  <i class="fa-regular fa-bookmark fa-lg"></i>
                  <span>Simpan</span>
                </a>
                @auth
                  <button type="button"
                    class="btn custom-btn leading-1px btn-primary btn-delete d-flex align-items-center gap-2"
                    data-bs-toggle="modal" data-bs-target="#modalLamarLoker" @disabled(Auth::user()->pelamar->id_pelamar === $registeredApplicantId)>
                    <i class="fa-solid fa-clipboard-check fa-lg"></i>
                    <span class="text-wrap">
                      @if (Auth::user()->pelamar->id_pelamar === $registeredApplicantId)
                        Kamu sudah melamar lowongan ini.
                      @else
                        Lamar sekarang
                      @endif
                    </span>
                  </button>
                @endauth
              </div>
            @endcan
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="card">
          <div class="card-body">
            <h4 class="text-center mb-3">Rekomendasi Lowongan</h4>
            <div class="row">
              <div class="col">
                <div class="d-flex gap-3 flex-column">
                  @forelse ($lowongan as $item)
                    <div class="card">
                      <div class="card-body table-responsive d-flex gap-3">
                        <div>
                          <img
                            src="{{ $item->perusahaan->logo_perusahaan ? asset('storage/' . $item->perusahaan->logo_perusahaan) : asset('assets/images/no-photo.png') }}"
                            width="100" alt="{{ $item->judul_lowongan }}">
                        </div>
                        <div class="my-auto">
                          <a class="text-decoration-none text-black font-bolder stretched-link"
                            href="{{ route('lowongan_kerja', $item->slug) }}">
                            <h4 class="fw-bold">{{ \Illuminate\Support\Str::limit($item->judul_lowongan, 20) }}</h4>
                          </a>
                          <p class="card-text">
                            <span class="fw-semibold fst-italic">{{ $item->perusahaan->nama_perusahaan }}</span>
                          </p>
                        </div>
                      </div>
                    </div>
                  @empty
                    hehe
                  @endforelse
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalLamarLoker" tabindex="-1" aria-labelledby="labelModalLamarLoker" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-3" id="labelModalLamarLoker">Lamar loker ini</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('lowongan.apply', $lowonganKerja->slug) }}" method="post"
          enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label for="surat_lamaran_kerja" class="form-label custom-font">Surat Lamaran Kerja</label>
              <input type="file" class="form-control" id="surat_lamaran_kerja" name="surat_lamaran_kerja">
            </div>
            <div>
              <label for="applicant_promotion" class="form-label custom-font">Promosikan diri kamu!</label>
              <input id="applicant_promotion" type="hidden" name="applicant_promotion">
              <trix-editor input="applicant_promotion"></trix-editor>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="custom-btn btn btn-secondary" data-bs-dismiss="modal">Close</button>
            @auth
              <button type="submit" class="custom-btn btn btn-primary" id="formSubmit">
                <i class="fa-solid fa-clipboard-check fa-lg"></i>
                <span class="text-wrap">
                  @if (Auth::user()->pelamar->id_pelamar === $registeredApplicantId)
                    Kamu sudah melamar lowongan ini.
                  @else
                    Lamar sekarang
                  @endif
                </span>
              </button>
            @endauth
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
