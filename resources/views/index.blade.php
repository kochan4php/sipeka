@extends('layouts.app')

@section('container')
  <section>
    <div class="row justify-content-center py-4">
      <div class="col-md-6 text-center">
        <h2 class="fs-2">Tentang Kami</h2>
        <p class="fs-5" style="text-align: justify">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iure,
          perspiciatis itaque. Nisi harum
          facilis velit vel
          quod laboriosam voluptatibus cupiditate eum, beatae magnam dolore incidunt, voluptatem deserunt cumque? Error
          totam temporibus earum adipisci excepturi, odio alias ea nemo optio? Deserunt harum temporibus ea, tenetur ad
          neque, sunt repellendus tempore sequi quas vitae nulla aspernatur fugit vero dolor qui hic nam eaque illo.
          Libero,
          accusamus? Necessitatibus consectetur quaerat similique eligendi inventore ratione et pariatur suscipit rem
          laudantium minus maiores, sed consequuntur voluptate quisquam sit at doloribus quia itaque! Ab laboriosam, eius
          obcaecati sit sint quos beatae necessitatibus explicabo fugit aperiam voluptas!</p>
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
