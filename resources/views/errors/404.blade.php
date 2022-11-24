<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <style>
    body {
      background-image: linear-gradient(-45deg, #0061ff, #60efff);
    }

    .row {
      min-height: 100vh
    }

    .not-found-title {
      font-size: 4rem;
    }
  </style>
  <title>404 Page Not Found</title>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-md-6">
        <div class="card text-center">
          <div class="card-body">
            <h1 class="not-found-title">404</h1>
            <p class="fs-4 mb-1"><span class="text-danger">Opps!</span> Halaman tidak ditemukan.</p>
            <p>Halaman yang kamu tuju mungkin tidak ada.</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
