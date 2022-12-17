@extends('layouts.app')

@section('container')
  <div id="carouselExampleControls" class="carousel slide" style="min-height: 650px !important;" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('assets/images/5.jpg') }}" style="height: 650px; object-fit: cover; object-position: bottom"
          class="img-fluid d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h1 class="fw-bold">WELCOME TO BKK SMKN 1 KOTA BEKASI</h1>
          <p>TEMUKAN PEKERJAAN SESUAI KOMPETENSIMU</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{ asset('assets/images/5.jpg') }}" style="height: 650px; object-fit: cover; object-position: center"
          class="img-fluid d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h1>Second slide label</h1>
          <p>Some representative placeholder content for the second slide.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{ asset('assets/images/5.jpg') }}" style="height: 650px; object-fit: cover; object-position: center"
          class="img-fluid d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h1>Third slide label</h1>
          <p>Some representative placeholder content for the third slide.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
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
        <div class="card-group owl-carousel owl-theme">
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
            Hehe
          @endforelse
        </div>
      </div>
    </section>

    <hr />

    <section id="lowongan-kerja" class="pb-5">
      <div class="row text-center justify-content-center pt-4">
        <div class="col">
          <h2 class="mb-5">Lowongan Tersedia</h2>
        </div>
      </div>

      <div class="row">
        <div class="card-group owl-carousel owl-theme">
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
            Hehe
          @endforelse
        </div>
      </div>
    </section>
  </div>

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
@endsection
