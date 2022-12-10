<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="{{ asset('assets/images/sipeka_logo_2.png') }}">

  @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  <title>SIPEKA | Login</title>
</head>

<body style="background-color: #00FFFF;">
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center" style="min-height: 100vh;">
      <div class="col-md-6 d-none d-md-block">
        <a href="{{ route('home') }}">
          <img src="{{ asset('assets/images/sipeka_logo.png') }}" class="img-fluid" alt="Logo SIPEKA">
        </a>
      </div>
      <div class="col-md-6">
        <div class="card px-4 pt-4 pb-2">
          <div class="card-body">
            <div>
              <h2 class="text-center mb-3">Login</h2>
            </div>
            <div>
              <x-alert-error-validation />
            </div>
            <div>
              <form action="{{ route('login.store') }}" method="post">
                @csrf
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="username" name="username" placeholder="deo-subarno">
                  <label for="username">Username or Email</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                  <label for="password">Password</label>
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="remember" name="remember">
                  <label class="form-check-label" for="remember">Remember Me</label>
                </div>
                <div class="row justify-content-between align-items-center">
                  <div class="col-5">
                    <button type="submit" class="btn btn-success w-100 fs-5 btn-sm">Login</button>
                  </div>
                  <div class="col-5 text-center">
                    <a href="#" class="text-right text-decoration-none">Forgot Password</a>
                  </div>
                </div>
              </form>
            </div>
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
    </div>
  </div>
  <script src="{{ asset('assets/js/disabled_inspect.js') }}"></script>
</body>

</html>
