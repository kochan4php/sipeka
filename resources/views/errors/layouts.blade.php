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
  <title>{{ $title ?? '' }}</title>
</head>

<body>
  <div class="container">
    @yield('error')
  </div>
</body>

</html>
