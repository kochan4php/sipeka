@extends('layouts.app')

@section('container')
  <div style="margin-top: 4rem !important">
    <div id="banner">
      <div id="blur">
        <div class="text-center">
          <h1 class="fw-bolder">WELCOME TO BKK SMKN 1 KOTA BEKASI</h1>
          <p class="fw-bold">TEMUKAN PEKERJAAN SESUAI KOMPETENSIMU</p>
        </div>
      </div>
    </div>
  </div>

  <div class="container my-4">
    <section>
      <div class="row justify-content-center py-4">
        <div class="col-md-8 text-center">
          <h2 class="fs-2">Tentang Kami</h2>
          <p class="fs-5 text-center">
            {{ __('Bursa Kerja Khusus (BKK) adalah sebuah lembaga yang dibentuk di Sekolah Menengah Kejuruan Negeri dan Swasta, sebagai unit pelaksana yang memberikan pelayanan dan informasi lowongan kerja, pelaksana pemasaran, penyaluran dan penempatan tenaga kerja, merupakan mitra Dinas Tenaga Kerja dan Transmigrasi.') }}
          </p>
        </div>
      </div>
    </section>

    <hr />

    <section id="cara-daftar">
      <div class="row text-center justify-content-center pt-4">
        <div class="col">
          <h2>Tujuan BKK</h2>
        </div>
      </div>
      <div class="row text-center justify-content-center pb-4 mt-3">
        <div class="col-md-6 col-lg-3">
          <div class="card mb-2">
            <div class="card-body pb-0">
              <p class="custom-font">
                Sebagai wadah dalam mempertemukan tamatan dengan pencari kerja.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card mb-2">
            <div class="card-body pb-0">
              <p class="custom-font">
                Memberikan layanan kepada tamatan sesuai dengan tugas dan fungsi masing-masing seksi yang ada dalam BKK.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card mb-2">
            <div class="card-body pb-0">
              <p class="custom-font">
                Sebagai wadah dalam pelatihan tamatan yang sesuai dengan permintaan pencari kerja.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card mb-2">
            <div class="card-body pb-0">
              <p class="custom-font">
                Sebagai wadah untuk menanamkan jiwa wirausaha bagi tamatan melalui pelatihan.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <hr />

    <section id="perusahaan" class="mb-5">
      <div class="row text-center justify-content-center pt-4">
        <div class="col mb-4">
          <h2>Perusahaan</h2>
          <p class="text-muted">List Perusahaan yang bekerja sama dengan pihak SMK Negeri 1 Kota Bekasi</p>
        </div>
      </div>

      <div class="row">
        <div class="card-group @if ($perusahaan->count() > 0) owl-carousel owl-theme @endif">
          @forelse ($perusahaan as $item)
            <div class="card mx-1">
              <img src="{{ $item->logo_perusahaan ?? asset('assets/images/no-photo.png') }}"
                class="card-img-top w-100 img-thumbnail" alt="{{ $item->nama_perusahaan }}">
              <div class="card-body ">
                <a class="card-title text-decoration-none text-black font-bolder stretched-link" href="/">
                  <h4 class="fst-italic">{{ $item->nama_perusahaan }}</h4>
                </a>
                <p class="card-text">{{ $item->deskripsi_perusahaan }}</p>
              </div>
            </div>
          @empty
            <div class="alert custom-font alert-warning w-full" role="alert">
              Perusahaan masih kosong.
            </div>
          @endforelse
        </div>
      </div>
    </section>

    <hr />

    <section id="lowongan-kerja" class="pb-5">
      <div class="row text-center justify-content-center pt-4">
        <div class="col">
          <h2 class="mb-5">Loker Terbaru</h2>
        </div>
      </div>

      <div class="row">
        <div class="card-group @if ($lowongan->count() > 0) owl-carousel owl-theme @endif">
          @forelse ($lowongan as $item)
            <div class="card mx-1">
              <img src="{{ $item->perusahaan->logo_perusahaan ?? asset('assets/images/no-photo.png') }}"
                class="card-img-top img-thumbnail" alt="{{ $item->judul_lowongan }}">
              <div class="card-body ">
                <a class="card-title text-decoration-none text-black font-bolder stretched-link"
                  href="{{ route('lowongan_kerja', $item->slug) }}">
                  <h4>{{ $item->judul_lowongan }}</h4>
                </a>
                <p class="card-text">
                  <span>Perusahaan : </span>
                  <span class="fw-bold fst-italic">{{ $item->perusahaan->nama_perusahaan }}</span>
                </p>
                <p class="card-text">{{ $item->deskripsi_lowongan }}</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">Created on {{ $item->created_at }}</small>
              </div>
            </div>
          @empty
            <div class="alert custom-font alert-warning w-full" role="alert">
              Loker masih kosong.
            </div>
          @endforelse
        </div>
      </div>
    </section>
  </div>
@endsection

@push('script-owl')
  <script>
    $(document).ready(function() {
      $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        nav: true,
        stagePadding: 50,
        mouseDrag: true,
        touchDrag: true,
        responsive: {
          0: {
            items: 1
          },
          500: {
            items: 2,
          },
          768: {
            items: 3,
          },
          1024: {
            items: 4,
          }
        }
      });
    });
  </script>
@endpush
