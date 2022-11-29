<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/owl-carousel/dist/assets/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/owl-carousel/dist/assets/owl.theme.default.min.css') }}">

  <title>Beranda | SIPEKA</title>
</head>

<body>
  @include('layouts.navigation')

  <div id="carouselExampleControls" class="carousel slide" style="min-height: 700px !important;"
    data-bs-ride="carousel">
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
    @yield('container')
  </div>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <script src="{{ asset('assets/owl-carousel/dist/owl.carousel.min.js') }}"></script>

  @stack('script-owl')
</body>

</html>
