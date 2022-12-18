@php
  $username = Auth::user()->username;
@endphp
<div class="col-lg-4">
  <img src="{{ asset('assets/images/6.jpeg') }}" style="height: 290px; object-fit: cover; object-position: center"
    class="img-fluid d-block w-100 rounded" alt="...">
  <div class="btn-group-vertical w-100 mt-4">
    <a href="{{ route('pelamar.index', $username) }}"
      class="btn @if (Request::is('sipeka/pelamar/' . $username . '/profile*')) bg-dark text-white @endif btn-outline-dark btn-block custom-font">
      Profil saya
    </a>
    <a href="{{ route('pelamar.dokumen', $username) }}"
      class="btn @if (Request::is('sipeka/pelamar/' . $username . '/dokumen*')) bg-dark text-white @endif btn-outline-dark btn-block custom-font">
      Dokumen saya
    </a>
    <a href="{{ route('pelamar.experience.index', $username) }}"
      class="btn @if (Request::is('sipeka/pelamar/' . $username . '/pengalaman-kerja*')) bg-dark text-white @endif btn-outline-dark btn-block custom-font">
      Pengalaman Kerja
    </a>
    <a href="{{ route('pelamar.pendidikan.index', $username) }}"
      class="btn @if (Request::is('sipeka/pelamar/' . $username . '/pendidikan*')) bg-dark text-white @endif btn-outline-dark btn-block custom-font">
      Pendidikan
    </a>
    <a href="{{ route('pelamar.lamaran.index', $username) }}"
      class="btn @if (Request::is('sipeka/pelamar/' . $username . '/lamaran-kerja*')) bg-dark text-white @endif btn-outline-dark btn-block custom-font">
      Progress lamaran kerja saya
    </a>
  </div>
</div>
