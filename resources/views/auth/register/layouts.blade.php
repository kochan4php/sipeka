<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="{{ asset('assets/images/sipeka_logo_2.png') }}">

  @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  <title>SIPEKA | {{ $title ?? '' }}</title>
</head>

<body style="background-color: #00FFFF;">
  <div class="container my-3">
    <div class="row d-flex justify-content-center align-items-center" style="min-height: 100vh;">
      <div class="col-md-6">
        <div class="card px-4 pt-4 pb-2">
          <div class="card-body">
            @yield('register')
          </div>
        </div>
        <div class="mt-4 card d-md-none">
          <div class="card-body">
            <a href="{{ route('home') }}" class="btn btn-primary w-100">
              Kembali ke halaman utama
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-6 d-none d-md-block">
        <a href="{{ route('home') }}">
          <img src="{{ asset('assets/images/sipeka_logo.png') }}" class="img-fluid" alt="Logo SIPEKA">
        </a>
      </div>
    </div>
  </div>
  <script src="{{ asset('assets/js/disabled_inspect.js') }}"></script>
</body>

</html>
