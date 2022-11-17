<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">

  <title>Beranda | SIPEKA</title>
</head>

<body>

  @include('layouts.navigation')

  <div id="carouselExampleControls" class="carousel slide" style="min-height: 80vh !important;" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="https://source.unsplash.com/1000x500?category=work" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h1>First slide label</h1>
          <p>Some representative placeholder content for the first slide.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="https://source.unsplash.com/1000x500?category=programming" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h1>Second slide label</h1>
          <p>Some representative placeholder content for the second slide.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="https://source.unsplash.com/1000x500?category=books" class="d-block w-100" alt="...">
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
</body>

</html>
