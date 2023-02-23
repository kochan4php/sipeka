<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <link rel="icon" href="{{ asset('assets/images/sipeka_logo_2.png') }}">

  <title>Dashboard SIPEKA | {{ $title ?? 'Beranda' }}</title>
  @notifyCss
  @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])

  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dashboard.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.min.css') }}" />

  @stack('style')
  @cloudinaryJS
</head>

<body>
  @include('layouts.dashboard.header')

  <div class="container-fluid">
    <div class="row">
      @include('layouts.dashboard.sidebar')

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5" data-aos="fade-down">
        @yield('container-dashboard')
      </main>
    </div>
  </div>

  <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/tippy.umd.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/pdfmake.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/vfs_fonts.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/datatables.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/disabled_inspect.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/enable_tooltip.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/init_datatables.js') }}"></script>

  @stack('script')
  <x:notify-messages />
  @notifyJs
</body>

</html>
