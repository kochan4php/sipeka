<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse bg-primary navbar-light sidebar-menu"
  style="padding-top: 3.35rem">
  <div class="position-sticky sidebar-sticky">
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-2 text-white">
      <span style="font-size: 15.5px !important;">Menu Utama</span>
    </h6>
    <ul class="nav flex-column gap-1">
      @can('admin')
        <li class="nav-item">
          <a class="nav-link @if (Request::is('sipeka/admin')) active @endif d-flex align-items-center gap-1"
            aria-current="page" href="{{ route('admin.index') }}">
            <i class="fa-solid fa-house fa-lg"></i>
            <span style="font-size: 15.5px !important;">Beranda</span>
          </a>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <button
              class="nav-link btn-dropdown bg-transparent border-0 text-left d-flex align-items-center justify-content-between gap-1 @if (Request::is('sipeka/admin/pengguna*')) active @endif"
              style="width: 100%;" type="button" data-bs-toggle="collapse" data-bs-target="#pengguna"
              aria-expanded="false" aria-controls="pengguna">
              <div class="d-flex align-items-center gap-1">
                <span><i class="fa-solid fa-user fa-lg"></i></span>
                <span style="font-size: 15.5px !important;">Pengguna</span>
              </div>
              <div>
                <i class="fa-solid fa-angle-left fa-lg"></i>
              </div>
            </button>
            <ul class="collapse list-unstyled bg-dark" id="pengguna">
              <li>
                <a class="nav-link dropdown-item @if (Request::is('sipeka/admin/pengguna/alumni*')) dropdown-item-active @endif d-flex gap-2 justify-content-between align-items-center"
                  href="{{ route('admin.alumni.index') }}">
                  <span>Alumni</span>
                  <span><i class="fa-solid fa-user-graduate fa-lg"></i></span>
                </a>
              </li>
              <li>
                <a class="nav-link dropdown-item @if (Request::is('sipeka/admin/pengguna/pelamar*')) dropdown-item-active @endif d-flex gap-2 justify-content-between align-items-center"
                  href="{{ route('admin.pelamar.index') }}">
                  <span>Masyarakat</span>
                  <span><i class="fa-solid fa-users fa-lg"></i></span>
                </a>
              </li>
              <li>
                <a class="nav-link dropdown-item @if (Request::is('sipeka/admin/pengguna/perusahaan*')) dropdown-item-active @endif d-flex gap-2 justify-content-between align-items-center"
                  href="{{ route('admin.perusahaan.index') }}">
                  <span>Mitra Perusahaan</span>
                  <span><i class="fa-solid fa-building fa-lg"></i></span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <button
              class="nav-link btn-dropdown bg-transparent border-0 text-left d-flex align-items-center justify-content-between gap-1 @if (Request::is('sipeka/admin/masterdata*')) active @endif"
              style="width: 100%;" type="button" data-bs-toggle="collapse" data-bs-target="#master_data"
              aria-expanded="false" aria-controls="master_data">
              <div class="d-flex align-items-center gap-1">
                <span><i class="fa-solid fa-database fa-lg"></i></span>
                <span style="font-size: 15.5px !important;">Master Data</span>
              </div>
              <div>
                <i class="fa-solid fa-angle-left fa-lg"></i>
              </div>
            </button>
            <ul class="collapse list-unstyled bg-dark" id="master_data">
              <li>
                <a class="nav-link dropdown-item @if (Request::is('sipeka/admin/masterdata/dokumen*')) dropdown-item-active @endif d-flex justify-content-between gap-2 align-items-center"
                  href="{{ route('admin.dokumen.index') }}">
                  <span>Jenis Dokumen</span>
                  <span><i class="fa-solid fa-file fa-lg"></i></span>
                </a>
              </li>
              <li>
                <a class="nav-link dropdown-item @if (Request::is('sipeka/admin/masterdata/angkatan*')) dropdown-item-active @endif d-flex justify-content-between gap-2 align-items-center"
                  href="{{ route('admin.angkatan.index') }}">
                  <span>Angkatan</span>
                  <span><i class="fa-solid fa-graduation-cap fa-lg"></i></span>
                </a>
              </li>
              <li>
                <a class="nav-link dropdown-item @if (Request::is('sipeka/admin/masterdata/jurusan*')) dropdown-item-active @endif d-flex justify-content-between gap-2 align-items-center"
                  href="{{ route('admin.jurusan.index') }}">
                  <span>Jurusan</span>
                  <span><i class="fa-solid fa-users-gear fa-lg"></i></span>
                </a>
              </li>
            </ul>
          </div>
        </li>
      @endcan
      @can('perusahaan')
        <li class="nav-item">
          <a class="nav-link @if (Request::is('sipeka/perusahaan')) active @endif d-flex align-items-center gap-1"
            aria-current="page" href="{{ route('perusahaan.index') }}">
            <i class="fa-solid fa-house fa-lg"></i>
            <span style="font-size: 15.5px !important;">Beranda</span>
          </a>
        </li>
      @endcan
    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-2 text-white">
      <span style="font-size: 15.5px !important;">Autentikasi</span>
    </h6>
    <div class="nav flex-column gap-1">
      <div class="nav-item text-nowrap">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="nav-link border-0 bg-transparent d-flex align-items-center gap-1 w-100">
            <span><i class="fa-solid fa-right-from-bracket fa-lg"></i></span>
            <span style="font-size: 15.5px !important;">Logout</span>
          </button>
        </form>
      </div>
    </div>
  </div>
</nav>
