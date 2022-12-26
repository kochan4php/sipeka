<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="{{ asset('assets/images/sipeka_logo_2.png') }}">

  @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/owl-carousel/dist/assets/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/owl-carousel/dist/assets/owl.theme.default.min.css') }}">

  @stack('style')

  <title>Beranda | SIPEKA</title>
</head>

<body>
  @include('layouts.navigation')
  <div class="mainlayout">
    @yield('container')
  </div>
  @include('layouts.footer')

  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <script src="{{ asset('assets/owl-carousel/dist/owl.carousel.min.js') }}"></script>

  @stack('script-owl')
  <script src="{{ asset('assets/js/disabled_inspect.js') }}"></script>
  <script src="{{ asset('assets/js/enable_tooltip.js') }}"></script>
</body>

</html>
