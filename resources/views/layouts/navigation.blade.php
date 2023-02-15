<nav class="navbar navbar-expand-lg navbar-light fw-bold fixed-top py-2-3" id="navbar">
  <div class="container">
    <a class="navbar-brand fs-4 fw-bold" href="{{ route('home') }}">SIPEKA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" style="font-size: 1.1rem !important;" href="{{ route('home') }}">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style="font-size: 1.1rem !important;" href="/sipeka#perusahaan">Perusahaan</a>
        </li>
        </li>
        <li class="nav-item">
          <a class="nav-link" style="font-size: 1.1rem !important;" href="/sipeka#lowongan-kerja">Lowongan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style="font-size: 1.1rem !important;" href="/sipeka/cara-daftar">Cara Daftar</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        @auth
          <li class="nav-item">
            <div class="dropdown">
              <button class="btn custom-btn btn-primary dropdown-toggle w-100 d-flex gap-2 align-items-center"
                type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-user"></i>
                <span>{{ Auth::user()->username }}</span>
              </button>
              <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end rounded-0"
                aria-labelledby="dropdownMenuButton2">
                <li>
                  @can('admin')
                    <a class="dropdown-item d-flex gap-2 align-items-center" href="{{ route('admin.index') }}">
                      <i class="fa-solid fa-gauge fa-lg"></i>
                      <span class="custom-font">My Dashboard</span>
                    </a>
                  @endcan
                  @can('perusahaan')
                    <a class="dropdown-item d-flex gap-2 align-items-center" href="{{ route('perusahaan.index') }}">
                      <i class="fa-solid fa-gauge fa-lg"></i>
                      <span class="custom-font">My Dashboard</span>
                    </a>
                  @endcan
                  @can('pelamar')
                    <a class="dropdown-item d-flex gap-2 align-items-center"
                      href="{{ route('pelamar.index', Auth::user()->username) }}">
                      <i class="fa-solid fa-address-card fa-lg"></i>
                      <span class="custom-font">Profile Saya</span>
                    </a>
                  @endcan
                </li>
                <li>
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item d-flex gap-2 align-items-center">
                      <i class="fa-solid fa-right-from-bracket fa-lg"></i>
                      <span class="custom-font">Logout</span>
                    </button>
                  </form>
                </li>
              </ul>
            </div>
          </li>
        @else
          <div class="d-flex flex-column flex-lg-row gap-2">
            <li class="nav-item">
              <a href="{{ route('login') }}" class="btn active custom-btn custom-font d-flex gap-2 align-items-center">
                <i class="fa-solid fa-right-to-bracket"></i>
                <span>Masuk</span>
              </a>
            </li>
            <li class="nav-item">
              <div class="dropdown">
                <button
                  class="btn custom-btn btn-success custom-font w-100 d-flex gap-2 align-items-center b align-items-center"
                  type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa-solid fa-user-plus"></i>
                  <span>Daftar</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-dark rounded-0 dropdown-menu-end"
                  aria-labelledby="dropdownMenuButton2">
                  <li>
                    <a class="dropdown-item" href="{{ route('register.kandidat') }}">
                      <i class="bi bi-house-door-fill"></i>
                      <span class="custom-font">Sebagai Kandidat Luar</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('register.alumni') }}">
                      <i class="bi bi-house-door-fill"></i>
                      <span class="custom-font">Sebagai Alumni</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
        </ul>
      </div>
      </li>
    </div>
  @endauth
  </ul>
  </div>
  </div>
</nav>
