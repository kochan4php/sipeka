<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <link rel="icon" href="{{ asset('assets/images/sipeka_logo_2.png') }}">

  <title>Dashboard SIPEKA | {{ $title ?? 'Beranda' }}</title>

  @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" />
</head>

<body>
  @include('layouts.dashboard.header')

  <div class="container-fluid">
    <div class="row">
      @include('layouts.dashboard.sidebar')

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
        @yield('container-dashboard')
      </main>
    </div>
  </div>
  @stack('script')
  <script src="{{ asset('assets/js/disabled_inspect.js') }}"></script>
  <script src="{{ asset('assets/js/enable_tooltip.js') }}"></script>
</body>

</html>
