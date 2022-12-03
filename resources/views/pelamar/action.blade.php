<div class="col-lg-4">
  <img src="{{ asset('assets/images/6.jpeg') }}" style="height: 290px; object-fit: cover; object-position: center"
    class="img-fluid d-block w-100 rounded" alt="...">
  <div class="btn-group-vertical w-100 mt-4">
    <a href="{{ route('pelamar.profile', 'cina') }}"
      class="btn @if (Request::is('sipeka/pelamar/cina/profile*')) bg-dark text-white @endif btn-outline-dark btn-block fs-5 btn-sm">
      Profil saya
    </a>
    <a href="{{ route('pelamar.dokumen', 'cina') }}"
      class="btn @if (Request::is('sipeka/pelamar/cina/dokumen*')) bg-dark text-white @endif btn-outline-dark btn-block fs-5 btn-sm">
      Dokumen saya
    </a>
    <a href="{{ route('pelamar.experience.index', 'cina') }}"
      class="btn @if (Request::is('sipeka/pelamar/cina/pengalaman-kerja*')) bg-dark text-white @endif btn-outline-dark btn-block fs-5 btn-sm">
      Pengalaman Kerja
    </a>
    <a href="{{ route('pelamar.lamaran.index', 'cina') }}"
      class="btn @if (Request::is('sipeka/pelamar/cina/lamaran-kerja*')) bg-dark text-white @endif btn-outline-dark btn-block fs-5 btn-sm">
      Progress lamaran kerja saya
    </a>
  </div>
</div>
