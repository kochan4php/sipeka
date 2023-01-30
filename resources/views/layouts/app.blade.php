<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="_token" content="{{ csrf_token() }}" />
  <link rel="icon" href="{{ asset('assets/images/sipeka_logo_2.png') }}">

  <title>Beranda | SIPEKA</title>
  @notifyCss
  @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/owl-carousel/dist/assets/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/owl-carousel/dist/assets/owl.theme.default.min.css') }}">

  @stack('style')
  @stack('head')
</head>

<body>
  @include('layouts.navigation')
  <div class="mainlayout" data-aos="fade-down">
    @yield('container')
  </div>
  @include('layouts.footer')

  <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/owl-carousel/dist/owl.carousel.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/tippy.umd.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/disabled_inspect.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/enable_tooltip.js') }}"></script>

  @stack('script-owl')
  @stack('script')
  <x:notify-messages />
  @notifyJs
</body>

</html>
