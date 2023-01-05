@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="pt-3 pb-1 mb-2">
    <h3 class="text-center">
      {{ __("Tahapan Seleksi Lowongan {$lowonganKerja->judul_lowongan} {$lowonganKerja->perusahaan->nama_perusahaan}") }}
    </h3>
    <div>
      <a href="{{ route('tahapan.seleksi.index') }}" class="btn btn-primary custom-btn mt-3">
        Kembali
      </a>
      <a href="{{ route('tahapan.seleksi.create', $lowonganKerja->slug) }}" class="btn btn-primary custom-btn mt-3">
        Tambah tahapan seleksi
      </a>
    </div>
  </div>

  <x-alert-session />

  <div class="row">
    <div class="col table-responsive">
      <div class="table-responsive pb-2">
        <table class="table table-bordered border-secondary border-1 table-striped mb-0">
          <thead class="table-dark">
            <tr>
              <th scope="col" class="text-nowrap text-center">No</th>
              <th scope="col" class="text-nowrap text-center">Nama Tahapan</th>
              <th scope="col" class="text-nowrap text-center">Urutan Tahapan</th>
              <th scope="col" class="text-nowrap text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($lowonganKerja->tahapan_seleksi as $tahapan)
              <tr>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $loop->iteration }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $tahapan->judul_tahapan }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $tahapan->urutan_tahapan_ke }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  <div>
                    <a href="{{ route('tahapan.seleksi.edit', ['lowongan_kerja' => $lowonganKerja->slug, 'tahapan_seleksi' => $tahapan->id_tahapan]) }}"
                      class="btn btn-primary custom-btn">
                      <i class="fa-solid fa-pen-to-square fa-lg"></i>
                    </a>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalHapus"
                      class="btn btn-danger custom-btn btn-delete" data-slug-lowongan="{{ $lowonganKerja->slug }}"
                      data-id-tahapan="{{ $tahapan->id_tahapan }}">
                      <i class="fa-solid fa-trash fa-lg"></i>
                    </button>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-nowrap text-center vertical-align-middle custom-font">
                  Lowongan ini belum memiliki tahapan seleksi
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
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
            <button type="button" class="btn custom-btn btn-secondary btn-cancel" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn custom-btn btn-danger">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  @push('script')
    <script>
      const btnDelete = document.querySelectorAll('.btn-delete');
      btnDelete.forEach(btn => {
        btn.addEventListener('click', () => {
          const formModal = document.querySelector('.modal .form-modal');
          const btnCancel = document.querySelector('.modal .btn-cancel');
          const btnClose = document.querySelector('.modal .btn-close');
          const idTahapan = btn.dataset.idTahapan;
          const slugLowongan = btn.dataset.slugLowongan;
          const route =
            "{{ route('tahapan.seleksi.delete', ['lowongan_kerja' => ':slugLowongan', 'tahapan_seleksi' => ':idTahapan']) }}";
          formModal.setAttribute('action', route
            .replace(':slugLowongan', slugLowongan)
            .replace(':idTahapan', idTahapan));
          btnCancel.addEventListener('click', () => formModal.removeAttribute('action'));
          btnClose.addEventListener('click', () => formModal.removeAttribute('action'));
        });
      });
    </script>
  @endpush
@endsection
