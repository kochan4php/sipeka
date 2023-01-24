<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <link rel="icon" href="{{ asset('assets/images/sipeka_logo_2.png') }}">

  <title>Dashboard SIPEKA | {{ $title ?? 'Beranda' }}</title>
  @notifyCss

  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-colvis-2.3.3/b-html5-2.3.3/r-2.4.0/sc-2.0.7/sb-1.4.0/sp-2.1.0/sl-1.5.0/datatables.min.css" />

  @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" />
  @stack('style')
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
  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <script src="https://unpkg.com/tippy.js@6"></script>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript"
    src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-colvis-2.3.3/b-html5-2.3.3/r-2.4.0/sc-2.0.7/sb-1.4.0/sp-2.1.0/sl-1.5.0/datatables.min.js">
  </script>
  <script src="{{ asset('assets/js/disabled_inspect.js') }}"></script>
  <script src="{{ asset('assets/js/enable_tooltip.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>
  <script type="text/javascript" src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
  @stack('script')
  <x:notify-messages />
  @notifyJs
</body>

</html>
