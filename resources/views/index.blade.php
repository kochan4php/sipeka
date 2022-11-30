@extends('layouts.app')

@section('container')
  <div id="carouselExampleControls" class="carousel slide" style="min-height: 700px !important;" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('assets/images/5.jpg') }}" style="height: 700px; object-fit: cover; object-position: center"
          class="img-fluid d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h1>First slide label</h1>
          <p>Some representative placeholder content for the first slide.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{ asset('assets/images/5.jpg') }}" style="height: 700px; object-fit: cover; object-position: center"
          class="img-fluid d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h1>Second slide label</h1>
          <p>Some representative placeholder content for the second slide.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{ asset('assets/images/5.jpg') }}" style="height: 700px; object-fit: cover; object-position: center"
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
          <p class="fs-5" style="text-align: justify">Lorem ipsum, dolor sit amet consectetur Bursa Kerja Khusus (BKK)
            adalah sebuah lembaga yang dibentuk di Sekolah Menengah Kejuruan Negeri dan Swasta, sebagai unit pelaksana
            yang memberikan pelayanan dan informasi lowongan kerja, pelaksana pemasaran, penyaluran dan penempatan tenaga
            kerja, merupakan mitra Dinas Tenaga Kerja dan Transmigrasi.</p>
        </div>
      </div>
    </section>

    <hr />

    <section id="cara-daftar">
      <div class="row text-center justify-content-center pt-4">
        <div class="col">
          <h2>Langkah Pendaftaran</h2>
        </div>
      </div>
      <div class="row text-center justify-content-center pb-4 mt-3">
        <div class="col-md-6 col-lg-3">
          <div class="card mb-2">
            <div class="card-body">
              <p style="text-align: justify">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem natus voluptatem excepturi laudantium qui
                veritatis odio veritatis odio veritatis odio nesciunt, asperiores eveniet eius!
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card mb-2">
            <div class="card-body">
              <p style="text-align: justify">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem natus voluptatem excepturi laudantium qui
                veritatis odio veritatis odio veritatis odio nesciunt, asperiores eveniet eius!
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card mb-2">
            <div class="card-body">
              <p style="text-align: justify">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem natus voluptatem excepturi laudantium qui
                veritatis odio veritatis odio veritatis odio nesciunt, asperiores eveniet eius!
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card mb-2">
            <div class="card-body">
              <p style="text-align: justify">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem natus voluptatem excepturi laudantium qui
                veritatis odio veritatis odio veritatis odio nesciunt, asperiores eveniet eius!
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <hr />

    <section id="lowongan-kerja">
      <div class="row text-center justify-content-center pt-4">
        <div class="col">
          <h2 class="mb-5">List Lowongan Kerja</h2>
        </div>
      </div>

      <div class="row">
        <div class="card-group owl-carousel owl-theme">
          <div class="card mx-1">
            <img src="{{ asset('assets/images/2.jpeg') }}" class="card-img-top w-100 img-thumbnail" alt="...">
            <div class="card-body ">
              <a class="card-title text-decoration-none text-black font-bolder stretched-link" href="/">
                <h4>IT Consultant</h4>
              </a>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                content.
                This content is a little bit longer.</p>
            </div>
            <div class="card-footer">
              <small class="text-muted">Last updated 3 mins ago</small>
            </div>
          </div>
          <div class="card mx-1">
            <img src="{{ asset('assets/images/3.jpeg') }}" class="card-img-top w-100 img-thumbnail" alt="...">
            <div class="card-body">
              <a class="card-title text-decoration-none text-black font-bolder stretched-link" href="/">
                <h4>System Analyst</h4>
              </a>
              <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
            </div>
            <div class="card-footer">
              <small class="text-muted">Last updated 3 mins ago</small>
            </div>
          </div>
          <div class="card mx-1">
            <img src="{{ asset('assets/images/4.jpeg') }}" class="card-img-top w-100 img-thumbnail" alt="...">
            <div class="card-body">
              <a class="card-title text-decoration-none text-black font-bolder stretched-link" href="/">
                <h4>Fullstack Dev</h4>
              </a>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                content.
                This card has even longer content than the first to show that equal height action.</p>
            </div>
            <div class="card-footer">
              <small class="text-muted">Last updated 3 mins ago</small>
            </div>
          </div>
          <div class="card mx-1">
            <img src="{{ asset('assets/images/3.jpeg') }}" class="card-img-top w-100 img-thumbnail" alt="...">
            <div class="card-body">
              <a class="card-title text-decoration-none text-black font-bolder stretched-link" href="/">
                <h4>Fullstack Dev</h4>
              </a>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                content.
                This card has even longer content than the first to show that equal height action.</p>
            </div>
            <div class="card-footer">
              <small class="text-muted">Last updated 3 mins ago</small>
            </div>
          </div>
          <div class="card mx-1">
            <img src="{{ asset('assets/images/2.jpeg') }}" class="card-img-top w-100 img-thumbnail" alt="...">
            <div class="card-body">
              <a class="card-title text-decoration-none text-black font-bolder stretched-link" href="/">
                <h4>Fullstack Dev</h4>
              </a>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                content.
                This card has even longer content than the first to show that equal height action.</p>
            </div>
            <div class="card-footer">
              <small class="text-muted">Last updated 3 mins ago</small>
            </div>
          </div>
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
              items: 1,
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
