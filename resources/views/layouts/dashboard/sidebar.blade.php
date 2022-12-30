<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse bg-primary navbar-light sidebar-menu"
  style="padding-top: 3.35rem">
  <div class="position-sticky sidebar-sticky">
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-2 text-white">
      <span style="font-size: 15.5px !important;">Menu Utama</span>
    </h6>
    <ul class="nav flex-column gap-1">
      @can('admin')
        <li class="nav-item">
          <a class="nav-link @if (Request::is('sipeka/dashboard/admin')) active @endif d-flex align-items-center gap-2"
            aria-current="page" href="{{ route('admin.index') }}">
            <i class="fa-solid fa-house fa-lg"></i>
            <span style="font-size: 15.5px !important;">Beranda</span>
          </a>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <button
              class="nav-link btn-dropdown bg-transparent border-0 text-left d-flex align-items-center justify-content-between gap-1 @if (Request::is('sipeka/dashboard/admin/pengguna*')) active @endif"
              style="width: 100%;" type="button" data-bs-toggle="collapse" data-bs-target="#pengguna"
              aria-expanded="false" aria-controls="pengguna">
              <div class="d-flex align-items-center gap-2">
                <span><i class="fa-solid fa-user fa-lg"></i></span>
                <span style="font-size: 15.5px !important;">Pengguna</span>
              </div>
              <div>
                <i class="fa-solid fa-angle-left fa-lg"></i>
              </div>
            </button>
            <ul class="collapse list-unstyled bg-dark" id="pengguna">
              <li>
                <a class="nav-link dropdown-item @if (Request::is('sipeka/dashboard/admin/pengguna/alumni*')) dropdown-item-active @endif d-flex gap-2 justify-content-between align-items-center"
                  href="{{ route('admin.alumni.index') }}">
                  <span>Alumni</span>
                  <span><i class="fa-solid fa-user-graduate fa-lg"></i></span>
                </a>
              </li>
              <li>
                <a class="nav-link dropdown-item @if (Request::is('sipeka/dashboard/admin/pengguna/pelamar*')) dropdown-item-active @endif d-flex gap-2 justify-content-between align-items-center"
                  href="{{ route('admin.pelamar.index') }}">
                  <span>Masyarakat</span>
                  <span><i class="fa-solid fa-users fa-lg"></i></span>
                </a>
              </li>
              <li>
                <a class="nav-link dropdown-item @if (Request::is('sipeka/dashboard/admin/pengguna/perusahaan*')) dropdown-item-active @endif d-flex gap-2 justify-content-between align-items-center"
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
              class="nav-link btn-dropdown bg-transparent border-0 text-left d-flex align-items-center justify-content-between gap-1 @if (Request::is('sipeka/dashboard/admin/masterdata*')) active @endif"
              style="width: 100%;" type="button" data-bs-toggle="collapse" data-bs-target="#master_data"
              aria-expanded="false" aria-controls="master_data">
              <div class="d-flex align-items-center gap-2">
                <span><i class="fa-solid fa-database fa-lg"></i></span>
                <span style="font-size: 15.5px !important;">Master Data</span>
              </div>
              <div>
                <i class="fa-solid fa-angle-left fa-lg"></i>
              </div>
            </button>
            <ul class="collapse list-unstyled bg-dark" id="master_data">
              <li>
                <a class="nav-link dropdown-item @if (Request::is('sipeka/dashboard/admin/masterdata/dokumen*')) dropdown-item-active @endif d-flex justify-content-between gap-2 align-items-center"
                  href="{{ route('admin.dokumen.index') }}">
                  <span>Jenis Dokumen</span>
                  <span><i class="fa-solid fa-file fa-lg"></i></span>
                </a>
              </li>
              <li>
                <a class="nav-link dropdown-item @if (Request::is('sipeka/dashboard/admin/masterdata/angkatan*')) dropdown-item-active @endif d-flex justify-content-between gap-2 align-items-center"
                  href="{{ route('admin.angkatan.index') }}">
                  <span>Angkatan</span>
                  <span><i class="fa-solid fa-graduation-cap fa-lg"></i></span>
                </a>
              </li>
              <li>
                <a class="nav-link dropdown-item @if (Request::is('sipeka/dashboard/admin/masterdata/jurusan*')) dropdown-item-active @endif d-flex justify-content-between gap-2 align-items-center"
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
          <a class="nav-link @if (Request::is('sipeka/dashboard/perusahaan')) active @endif d-flex align-items-center gap-2"
            aria-current="page" href="{{ route('perusahaan.index') }}">
            <i class="fa-solid fa-house fa-lg"></i>
            <span style="font-size: 15.5px !important;">Beranda</span>
          </a>
        </li>
      @endcan
      @canany(['admin', 'perusahaan'])
        @if (\App\Models\MitraPerusahaan::all()->count() > 0)
          <li class="nav-item">
            <a class="nav-link @if (Request::is('sipeka/dashboard/lowongan*')) active @endif d-flex align-items-center gap-2"
              aria-current="page" href="{{ route('lowongankerja.index') }}">
              <i class="fa-solid fa-magnifying-glass fa-lg"></i>
              <span style="font-size: 15.5px !important;">Lowongan</span>
            </a>
          </li>
        @endif
        @if (\App\Models\LowonganKerja::all()->count() > 0)
          <li class="nav-item">
            <div class="dropdown">
              <button
                class="nav-link btn-dropdown bg-transparent border-0 text-left d-flex align-items-center justify-content-between gap-1 @if (Request::is('sipeka/dashboard/seleksi*')) active @endif"
                style="width: 100%;" type="button" data-bs-toggle="collapse" data-bs-target="#penilaian"
                aria-expanded="false" aria-controls="penilaian">
                <div class="d-flex align-items-center gap-2">
                  <span><i class="fa-solid fa-user-check fa-lg"></i></span>
                  <span style="font-size: 15.5px !important;">Seleksi</span>
                </div>
                <div>
                  <i class="fa-solid fa-angle-left fa-lg"></i>
                </div>
              </button>
              <ul class="collapse list-unstyled bg-dark" id="penilaian">
                <li>
                  <a class="nav-link dropdown-item @if (Request::is('sipeka/dashboard/seleksi/tahapan*')) dropdown-item-active @endif d-flex justify-content-between gap-2 align-items-center"
                    href="{{ route('tahapan.seleksi.index') }}">
                    <span>Lamaran Kerja</span>
                    <i class="fa-solid fa-code-branch fa-lg"></i>
                  </a>
                </li>
                <li>
                  <a class="nav-link dropdown-item @if (Request::is('sipeka/dashboard/seleksi/penilaian*')) dropdown-item-active @endif d-flex justify-content-between gap-2 align-items-center"
                    href="">
                    <span>Penilaian Seleksi</span>
                    <i class="fa-solid fa-clipboard-check fa-lg"></i>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endif
      @endcanany
      @can('admin')
        <li class="nav-item">
          <a class="nav-link @if (Request::is('sipeka/dashboard/admin/profile*')) active @endif d-flex align-items-center gap-2"
            aria-current="page" href="{{ route('admin.profile.index', Auth::user()->admin->id_admin) }}">
            <i class="fa-regular fa-id-card fa-lg"></i>
            <span style="font-size: 15.5px !important;">Profil Saya</span>
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
          <button type="submit" class="nav-link border-0 bg-transparent d-flex align-items-center gap-2 w-100">
            <span><i class="fa-solid fa-right-from-bracket fa-lg"></i></span>
            <span style="font-size: 15.5px !important;">Logout</span>
          </button>
        </form>
      </div>
    </div>
  </div>
</nav>
