<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  <title>SIPEKA | Login</title>
</head>

<body style="background-color: #00FFFF;">
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center" style="min-height: 100vh;">
      <div class="col-md-6 d-none d-md-block">

      </div>
      <div class="col-md-6">
        <div class="card p-md-3">
          <div class="card-body">
            <h2 class="text-center mb-3">Login</h2>
            <form action="{{ route('login.store') }}" method="post">
              @csrf
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="deo-subarno">
                <label for="username">Username</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <label for="password">Password</label>
              </div>
              <div class="row justify-content-between align-items-center">
                <div class="col-5">
                  <button type="submit" class="btn btn-success w-100">Login</button>
                </div>
                <div class="col-5 text-right">
                  <a href="#" class="text-right text-decoration-none">Forgot Password</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('assets/js/disabled_inspect.js') }}"></script>
</body>

</html>
