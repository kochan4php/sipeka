<nav class="navbar navbar-expand-lg bg-danger navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="#">SIPEKA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav justify-content-between">
        <li class="nav-item">
          <a class="nav-link @if (Request::is('/sipeka')) 'active' @endif" href="/">Beranda</a>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <a class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Lowongan Kerja
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="#">Daftar Lowongan Kerja</a></li>
              <li><a class="dropdown-item" href="#">Lowongan yang saya lamar</a></li>
            </ul>
          </div>
        </li>
        @auth
          <li class="nav-item">
            <div class="dropdown">
              <a class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Profil Saya
              </a>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="#">Dashboard</a></li>
                <li><a class="dropdown-item" href="#">Keluar</a></li>
              </ul>
            </div>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="#">Masuk</a>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
