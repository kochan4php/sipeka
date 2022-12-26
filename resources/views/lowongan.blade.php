@extends('layouts.app')

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
    <x-alert-session />
    @if ($lowonganKerja->tahapan_seleksi->count() === 0)
      <div class="alert alert-danger custom-font" role="alert">
        <span>Kamu tidak bisa mendaftar di lowongan ini karena lowongan ini belum memiliki Tahapan Seleksi.</span>
        <span class="fw-bold">Silahkan hubungi Admin.</span>
      </div>
    @endif
    <div class="row gap-3 gap-lg-0">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <div class="mb-3">
              <img src="{{ asset('assets/images/no-photo.png') }}" class="img-fluid w-100 rounded"
                alt="{{ $lowonganKerja->perusahaan->nama_perusahaan }}" draggable="false">
            </div>
            <div class="mb-4">
              <h1>{{ $lowonganKerja->judul_lowongan }}</h1>
              <h5 class="fst-italic">{{ $lowonganKerja->perusahaan->nama_perusahaan }}</h5>
            </div>
            <div>
              <h5 class="fw-bolder">Deskripsi Pekerjaan</h5>
            </div>
            <div class="mb-4">
              {!! $lowonganKerja->deskripsi_lowongan !!}
            </div>

            <hr />

            <div>
              <h5 class="fw-bolder">Tahapan Seleksi</h5>
            </div>
            <div class="mb-4 d-flex flex-column gap-3">
              @forelse ($lowonganKerja->tahapan_seleksi as $tahapan)
                <div class="card cursor-pointer">
                  <div class="card-body">
                    <div class="custom-font d-flex flex-column gap-2">
                      <span>Urutan tahapan : Ke-{{ $tahapan->urutan_tahapan_ke }}</span>
                      <span>Judul tahapan : {{ $tahapan->judul_tahapan }}</span>
                    </div>
                  </div>
                </div>
              @empty
                <div class="card">
                  <div class="card-body">
                    Kosong
                  </div>
                </div>
              @endforelse
            </div>

            <hr />

            <div>
              <h5 class="fw-bolder">Deskripsi Perusahaan</h5>
            </div>
            <div class="mb-4 custom-font">
              {!! $lowonganKerja->perusahaan->deskripsi_perusahaan ?? 'Perusahaan ini belum memiliki deskripsi' !!}
            </div>
            @can('pelamar')
              <div class="d-flex gap-2 w-100">
                <a href="{{ route('admin.perusahaan.edit', '') }}"
                  class="btn custom-font d-flex gap-2 align-items-center justify-content-center leading-1px btn-info">
                  <i class="fa-regular fa-bookmark fa-lg"></i>
                  <span>Simpan</span>
                </a>
                @if ($lowonganKerja->tahapan_seleksi->count() > 0)
                  <form action="{{ route('lowongan.apply', $lowonganKerja->slug) }}" method="post">
                    @csrf
                    <button type="submit"
                      class="btn custom-font leading-1px btn-primary btn-delete d-flex align-items-center gap-2"
                      @disabled(Auth::user()->pelamar->id_pelamar === $registeredApplicantId)>
                      <i class="fa-solid fa-clipboard-check fa-lg"></i>
                      <span class="text-wrap">
                        @if (Auth::user()->pelamar->id_pelamar === $registeredApplicantId)
                          Kamu sudah melamar lowongan ini.
                        @else
                          Lamar sekarang
                        @endif
                      </span>
                    </button>
                  </form>
                @endif
              </div>
            @endcan
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <h4 class="text-center mb-3">Rekomendasi Lowongan</h4>
            <div class="row">
              <div class="col">
                <div class="d-flex gap-3 flex-column">
                  @forelse ($lowongan as $item)
                    <div class="card">
                      <div class="card-body table-responsive p-0 d-flex gap-3">
                        <div>
                          <img
                            src="{{ $item->perusahaan->logo_perusahaan ? asset('storage/' . $item->perusahaan->logo_perusahaan) : asset('assets/images/no-photo.png') }}"
                            class="rounded" width="100" alt="{{ $item->judul_lowongan }}">
                        </div>
                        <div class="my-auto">
                          <a class="text-decoration-none text-black font-bolder stretched-link"
                            href="{{ route('lowongan_kerja', $item->slug) }}">
                            <h4 class="fw-bolder">{{ $item->judul_lowongan }}</h4>
                          </a>
                          <p class="card-text">
                            <span>Perusahaan : </span>
                            <span class="fw-bold fst-italic">{{ $item->perusahaan->nama_perusahaan }}</span>
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
@endsection
