@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
    <h1>Data Lowongan Kerja</h1>
  </div>

  <x-alert-session />

  <div class="row">
    <div class="col table-responsive">
      <div class="table-responsive pb-2">
        <table class="table table-bordered border-secondary border-1 table-striped mb-0">
          <thead class="table-dark">
            <tr>
              <th scope="col" class="text-nowrap text-center">No</th>
              <th scope="col" class="text-nowrap text-center">Judul Lowongan</th>
              @can('admin')
                <th scope="col" class="text-nowrap text-center">Nama Perusahaan</th>
              @endcan
              @canany(['admin', 'perusahaan'])
                <th scope="col" class="text-nowrap text-center">Tahapan Seleksi</th>
                <th scope="col" class="text-nowrap text-center">Tambah Tahapan Seleksi</th>
              @endcanany
            </tr>
          </thead>
          <tbody>
            @foreach ($lowongan as $item)
              <tr>
                <th class="text-nowrap text-center vertical-align-middle custom-font" scope="row">
                  {{ $loop->iteration }}.
                </th>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->judul_lowongan }}
                </td>
                @can('admin')
                  <td class="text-nowrap text-center vertical-align-middle custom-font">
                    {{ $item->perusahaan->nama_perusahaan }}
                  </td>
                @endcan
                @canany(['admin', 'perusahaan'])
                  <td class="text-nowrap" style="font-size: 0.95rem">
                    <div class="d-flex flex-column gap-2">
                      @forelse ($item->tahapan_seleksi as $tahapan)
                        <div class="card">
                          <div class="card-body">
                            <div class="d-flex gap-2 justify-content-between">
                              <div class="d-flex gap-2">
                                <div>{{ $loop->iteration }}.&nbsp;</div>
                                <div class="d-flex flex-column">
                                  <span>Urutan tahapan : Ke-{{ $tahapan->urutan_tahapan_ke }}</span>
                                  <span>Judul tahapan : {{ $tahapan->judul_tahapan }}</span>
                                </div>
                              </div>
                              <div class="btn-group">
                                <a href="{{ route('tahapan.seleksi.edit', ['lowongan_kerja' => $item->slug, 'tahapan_seleksi' => $tahapan->slug]) }}"
                                  class="btn btn-sm btn-warning d-flex align-items-center justify-content-center">
                                  <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                </a>
                                <button type="button" data-slug-tahapan="{{ $tahapan->slug }}"
                                  data-slug-lowongan="{{ $tahapan->lowongan->slug }}"
                                  class="btn btn-sm btn-danger d-flex align-items-center justify-content-center btn-delete"
                                  data-bs-toggle="modal" data-bs-target="#modalHapus">
                                  <i class="fa-solid fa-trash fa-lg"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      @empty
                        <div class="card">
                          <div class="card-body">
                            Lowongan ini belum memiliki tahapan seleksi.
                          </div>
                        </div>
                      @endforelse
                    </div>
                  </td>
                  <td class="text-nowrap text-center vertical-align-middle">
                    <a href="{{ route('tahapan.seleksi.create', $item->slug) }}" class="btn btn-primary btn-sm"
                      style="font-size: 0.9rem">
                      Tambah Tahapan Seleksi
                    </a>
                  </td>
                @endcanany
              </tr>
            @endforeach
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
            <button type="button" class="btn btn-secondary btn-cancel" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger">Hapus</button>
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
          const slugTahapan = btn.dataset.slugTahapan;
          const slugLowongan = btn.dataset.slugLowongan;
          const route =
            "{{ route('tahapan.seleksi.delete', ['lowongan_kerja' => ':slugLowongan', 'tahapan_seleksi' => ':slugTahapan']) }}";
          formModal.setAttribute('action', route
            .replace(':slugLowongan', slugLowongan)
            .replace(':slugTahapan', slugTahapan));
          btnCancel.addEventListener('click', () => formModal.removeAttribute('action'));
          btnClose.addEventListener('click', () => formModal.removeAttribute('action'));
        });
      });
    </script>
  @endpush
@endsection
