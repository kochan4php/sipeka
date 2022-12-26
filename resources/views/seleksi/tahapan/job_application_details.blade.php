@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="row pt-3 pb-1 mb-1">
    <div class="col">
      <div class="card">
        <div class="card-header pb-0">
          <h2 class="text-center">Detail Data Lamaran Kerja</h2>
        </div>
        <div class="card-body">
          <x-alert-session />
          <div class="row gap-3 gap-lg-0">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body d-flex justify-content-center align-items-center pb-2">
                  <h4 class="text-center fw-bolder">Detail data pelamar</h4>
                </div>
              </div>
              <ul class="mt-3 list-group custom-font list-group-numbered">
                <li class="list-group-item">
                  <span>{{ __('Judul Lowongan : ') }}</span>
                  <span class="fw-bold fst-italic">
                    {{ __($pendaftaranLowongan->lowongan->judul_lowongan) }}
                  </span>
                </li>
                <li class="list-group-item">
                  <span>{{ __('Nama Perusahaan : ') }}</span>
                  <span class="fw-bold fst-italic">
                    {{ __($pendaftaranLowongan->lowongan->perusahaan->nama_perusahaan) }}
                  </span>
                </li>
                <li class="list-group-item">
                  <span>{{ __('Nama Pelamar : ') }}</span>
                  <span class="fw-bold fst-italic">
                    @if (!is_null($pendaftaranLowongan->pelamar->alumni))
                      {{ __($pendaftaranLowongan->pelamar->alumni->nama_lengkap) }}
                    @else
                      {{ __($pendaftaranLowongan->pelamar->masyarakat->nama_lengkap) }}
                    @endif
                  </span>
                </li>
                <li class="list-group-item">
                  <span>{{ __('Alumni / Kandidat Luar : ') }}</span>
                  <span class="fw-bold fst-italic">
                    @if (!is_null($pendaftaranLowongan->pelamar->alumni))
                      {{ __('Alumni') }}
                    @else
                      {{ __('Kandidat Luar') }}
                    @endif
                  </span>
                </li>
                <li class="list-group-item">
                  <span>{{ __('Kode Pendaftaran : ') }}</span>
                  <span class="fw-bold fst-italic">
                    {{ __($pendaftaranLowongan->kode_pendaftaran) }}
                  </span>
                </li>
              </ul>
            </div>

            <hr class="my-3 px-2 d-lg-none" />

            <div class="col-lg-6">
              <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <h4 class="fw-bolder">Tahapan seleksi</h4>
                  <a href="{{ route('tahapan.seleksi.create', $pendaftaranLowongan->id_pendaftaran) }}"
                    class="btn btn-primary custom-btn btn-sm" id="addTahapanSeleksi">
                    <i class="fa-solid fa-plus fa-lg"></i>
                  </a>
                </div>
              </div>
              <ul class="mt-3 list-group custom-font">
                @forelse ($pendaftaranLowongan->tahapan_seleksi as $tahapan)
                  <li class="list-group-item d-flex justify-content-between">
                    <div class="d-flex flex-column">
                      <span>Urutan tahapan : Ke-{{ $tahapan->urutan_tahapan_ke }}</span>
                      <span>Judul tahapan : {{ $tahapan->judul_tahapan }}</span>
                    </div>
                    <div class="btn-group gap-2">
                      <a href="{{ route('tahapan.seleksi.edit', ['pendaftaran_lowongan' => $tahapan->pendaftaran->id_pendaftaran, 'tahapan_seleksi' => $tahapan->id_tahapan]) }}"
                        class="btn btn-sm custom-btn btn-warning d-flex align-items-center justify-content-center btn-edit">
                        <i class="fa-solid fa-pen-to-square fa-lg"></i>
                      </a>
                      <button type="button" data-id-tahapan="{{ $tahapan->id_tahapan }}"
                        data-id-pendaftaran="{{ $tahapan->pendaftaran->id_pendaftaran }}"
                        class="btn btn-sm custom-btn btn-danger d-flex align-items-center justify-content-center btn-delete"
                        data-bs-toggle="modal" data-bs-target="#modalHapus">
                        <i class="fa-solid fa-trash fa-lg"></i>
                      </button>
                    </div>
                  </li>
                @empty
                  <li class="list-group-item">
                    {{ __('Tahapan seleksi belum ada.') }}
                  </li>
                @endforelse
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalHapus" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header border-0 border-bottom-0">
          <h1 class="modal-title fs-4 text-center" id="exampleModalLabel">Hapus data Tahapan Seleksi?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer border-0 border-top-0">
          <form method="post" class="form-modal">
            @csrf
            @method('delete')
            <button type="button" class="btn btn-secondary btn-cancel" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('script')
  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <script src="https://unpkg.com/tippy.js@6"></script>
  <script>
    tippy('#addTahapanSeleksi', {
      content: 'Tambah tahapan seleksi',
      arrow: true,
      placement: 'left',
    })
    tippy('.btn-edit', {
      content: 'Edit tahapan seleksi',
      arrow: true,
      placement: 'left',
    })
    tippy('.btn-delete', {
      content: 'Hapus tahapan seleksi',
      arrow: true,
      placement: 'left',
    })
  </script>
  <script>
    const btnDelete = document.querySelectorAll('.btn-delete');
    btnDelete.forEach(btn => {
      btn.addEventListener('click', () => {
        const formModal = document.querySelector('.modal .form-modal');
        const btnCancel = document.querySelector('.modal .btn-cancel');
        const btnClose = document.querySelector('.modal .btn-close');
        const idTahapan = btn.dataset.idTahapan;
        const idPendaftaran = btn.dataset.idPendaftaran;
        const route =
          "{{ route('tahapan.seleksi.delete', ['pendaftaran_lowongan' => ':idPendaftaran', 'tahapan_seleksi' => ':idTahapan']) }}";
        formModal.setAttribute('action', route
          .replace(':idPendaftaran', idPendaftaran)
          .replace(':idTahapan', idTahapan));
        btnCancel.addEventListener('click', () => formModal.removeAttribute('action'));
        btnClose.addEventListener('click', () => formModal.removeAttribute('action'));
      });
    });
  </script>
@endpush
