<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse bg-primary navbar-light sidebar-menu"
  style="padding-top: 3.35rem">
  <div class="position-sticky sidebar-sticky">
    <ul class="nav flex-column gap-1">
      <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" aria-current="page" href="{{ route('home') }}">
          <i class="fa-solid fa-house fa-lg"></i>
          <span style="font-size: 15.5px !important;">Beranda</span>
        </a>
      </li>
      @can('admin')
        <li class="nav-item">
          <a class="nav-link  @if (Request::is('sipeka/dashboard/admin')) active @endif d-flex align-items-center gap-2"
            aria-current="page" href="{{ route('admin.index') }}">
            <i class="fa-solid fa-gauge fa-lg"></i>
            <span style="font-size: 15.5px !important;">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <button
              class="nav-link  btn-dropdown bg-transparent border-0 text-left d-flex align-items-center justify-content-between gap-1 @if (Request::is('sipeka/dashboard/admin/masterdata*')) active @endif"
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
                <a class="nav-link  dropdown-item @if (Request::is('sipeka/dashboard/admin/masterdata/dokumen*')) dropdown-item-active @endif d-flex justify-content-between gap-2 align-items-center"
                  href="{{ route('admin.dokumen.index') }}">
                  <span>Dokumen</span>
                  <span><i class="fa-solid fa-file fa-lg"></i></span>
                </a>
              </li>
              <li>
                <a class="nav-link  dropdown-item @if (Request::is('sipeka/dashboard/admin/masterdata/angkatan*')) dropdown-item-active @endif d-flex justify-content-between gap-2 align-items-center"
                  href="{{ route('admin.angkatan.index') }}">
                  <span>Angkatan</span>
                  <span><i class="fa-solid fa-graduation-cap fa-lg"></i></span>
                </a>
              </li>
              <li>
                <a class="nav-link  dropdown-item @if (Request::is('sipeka/dashboard/admin/masterdata/jurusan*')) dropdown-item-active @endif d-flex justify-content-between gap-2 align-items-center"
                  href="{{ route('admin.jurusan.index') }}">
                  <span>Jurusan</span>
                  <span><i class="fa-solid fa-users-gear fa-lg"></i></span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li>
          <a class="nav-link  @if (Request::is('sipeka/dashboard/admin/pengguna*')) active @endif d-flex align-items-center gap-2"
            href="{{ route('admin.pengguna.index') }}">
            <span><i class="fa-solid fa-users fa-lg"></i></span>
            <span>User</span>
          </a>
        </li>
        <li>
          <a class="nav-link  @if (Request::is('sipeka/dashboard/admin/alumni*')) active @endif d-flex align-items-center gap-2"
            href="{{ route('admin.alumni.index') }}">
            <span><i class="fa-solid fa-user-graduate fa-lg"></i></span>
            <span>Alumni</span>
          </a>
        </li>
        <li>
          <a class="nav-link  @if (Request::is('sipeka/dashboard/admin/pelamar*')) active @endif d-flex align-items-center gap-2"
            href="{{ route('admin.pelamar.index') }}">
            <span><i class="fa-solid fa-person fa-lg"></i></span>
            <span>Kandidat Luar</span>
          </a>
        </li>
        <li>
          <a class="nav-link  @if (Request::is('sipeka/dashboard/admin/perusahaan*')) active @endif d-flex align-items-center gap-2"
            href="{{ route('admin.perusahaan.index') }}">
            <span><i class="fa-solid fa-city fa-lg"></i></span>
            <span>Mitra Perusahaan</span>
          </a>
        </li>
      @endcan
      @can('perusahaan')
        <li class="nav-item">
          <a class="nav-link  @if (Request::is('sipeka/dashboard/perusahaan')) active @endif d-flex align-items-center gap-2"
            aria-current="page" href="{{ route('perusahaan.index') }}">
            <i class="fa-solid fa-gauge fa-lg"></i>
            <span style="font-size: 15.5px !important;">Dashboard</span>
          </a>
        </li>
      @endcan
      @canany(['admin', 'perusahaan'])
        <li>
          <a class="nav-link @if (Request::is('sipeka/dashboard/kantor*')) active @endif d-flex align-items-center gap-2"
            href="{{ route('kantor.index') }}">
            <span><i class="fa-solid fa-building fa-lg"></i></span>
            <span>Kantor</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  @if (Request::is('sipeka/dashboard/lowongan*') || Request::is('sipeka/dashboard/admin/pendaftaran-lowongan*')) active @endif d-flex align-items-center gap-2"
            aria-current="page" href="{{ route('lowongankerja.index') }}">
            <i class="fa-solid fa-briefcase fa-lg"></i>
            <span style="font-size: 15.5px !important;">Lowongan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  @if (Request::is('sipeka/dashboard/rekomendasi*')) active @endif d-flex align-items-center gap-2"
            aria-current="page" href="{{ route('rekomendasi.index') }}">
            <i class="fa-solid fa-star fa-lg"></i>
            <span style="font-size: 15.5px !important;">Rekomendasi</span>
          </a>
        </li>
      @endcanany
      @can('admin')
        <li class="nav-item">
          <a class="nav-link  @if (Request::is('sipeka/dashboard/admin/profile*')) active @endif d-flex align-items-center gap-2"
            aria-current="page" href="{{ route('admin.profile.index', Auth::user()->admin->id_admin) }}">
            <i class="fa-regular fa-id-card fa-lg"></i>
            <span style="font-size: 15.5px !important;">Profil Saya</span>
          </a>
        </li>
      @endcan
      @can('perusahaan')
        <li class="nav-item">
          <a class="nav-link  @if (Request::is('sipeka/dashboard/perusahaan/profile*')) active @endif d-flex align-items-center gap-2"
            aria-current="page" href="">
            <i class="fa-regular fa-id-card fa-lg"></i>
            <span style="font-size: 15.5px !important;">Profil Saya</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  @if (Request::is('sipeka/dashboard/perusahaan/pelamar*')) active @endif d-flex align-items-center gap-2"
            aria-current="page" href="{{ route('perusahaan.pelamar.index') }}">
            <i class="fa-solid fa-file-contract fa-lg"></i>
            <span style="font-size: 15.5px !important;">Pelamar</span>
          </a>
        </li>
      @endcan
      <li class="nav-item text-nowrap">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="nav-link  border-0 bg-transparent d-flex align-items-center gap-2 w-100">
            <span><i class="fa-solid fa-right-from-bracket fa-lg"></i></span>
            <span style="font-size: 15.5px !important;">Logout</span>
          </button>
        </form>
      </li>
    </ul>
  </div>
</nav>
