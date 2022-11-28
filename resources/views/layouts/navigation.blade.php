<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow py-3">
  <div class="container">
    <a class="navbar-brand fs-4 fw-bold" href="{{ route('home') }}">SIPEKA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link custom-font" href="{{ route('home') }}">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link custom-font" href="/">Lowongan Kerja</a>
        </li>
        <li class="nav-item">
          <a class="nav-link custom-font" href="/">Cara Daftar</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        @auth
          <li class="nav-item">
            <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle w-100" type="button" id="dropdownMenuButton2"
                data-bs-toggle="dropdown" aria-expanded="false">
                {{-- <i class="bi bi-person-circle"></i>&nbsp;{{ Auth::user()->name }} --}}
                Dropdown
              </button>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                <li>
                  <a class="dropdown-item" href="/dashboard">
                    <i class="bi bi-house-door-fill"></i>&nbsp;Dashboard
                  </a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li>
                  <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item">
                      <i class="bi bi-box-arrow-left"></i>&nbsp;Logout
                    </button>
                  </form>
                </li>
              </ul>
            </div>
          </li>
        @else
          <li class="nav-item">
            <a href="{{ route('login.index') }}"
              class="nav-link active custom-font d-flex gap-2 align-items-center btn-login">
              <i class="fa-solid fa-right-to-bracket"></i>
              <span>Login</span>
            </a>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
