@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
    <h2>Data Dokumen</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
      Tambah Data Dokumen
    </button>
  </div>

  <x-alert-session />

  <div class="row">
    <div class="col table-responsive">
      <div class="card table-responsive">
        <div class="card-body">
          <table class="table table-bordered border-secondary border-1 table-striped mb-0">
            <thead class="table-dark">
              <tr>
                <th scope="col" class="text-nowrap text-center">No</th>
                <th scope="col" class="text-nowrap text-center">Kode Jenis Dokumen</th>
                <th scope="col" class="text-nowrap text-center">Jenis Dokumen</th>
                <th scope="col" class="text-nowrap text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($dokumen as $item)
                <tr>
                  <th class="text-nowrap text-center" scope="row">{{ $loop->iteration }}</th>
                  <td class="text-nowrap text-center">{{ $item->id_jenis_dokumen }}</td>
                  <td class="text-nowrap text-center">{{ $item->nama_dokumen }}</td>
                  <td class="text-nowrap text-center">
                    <div class="btn-group">
                      <button type="button" data-bs-toggle="modal" data-bs-target="#modalSunting"
                        data-kode-dokumen="{{ $item->id_jenis_dokumen }}"
                        class="btn btn-sm fw-bolder leading-1px btn-warning btn-edit">
                        <span><i class="fa-solid fa-pen-to-square fa-lg"></i></span>
                        <span>Sunting</span>
                      </button>
                      <button type="button" class="btn btn-sm fw-bolder leading-1px btn-danger btn-delete"
                        data-kode-dokumen="{{ $item->id_jenis_dokumen }}" data-bs-toggle="modal"
                        data-bs-target="#modalHapus">
                        <span><i class="fa-solid fa-trash fa-lg"></i></span>
                        <span>Hapus</span>
                      </button>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal Tambah --}}
  <div class="modal fade" id="modalTambah" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalTambahLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-4 text-center" id="modalTambahLabel">Tambah data jenis dokumen</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.dokumen.store') }}" method="post">
            @csrf
            <div class="mb-3 row">
              <label for="kode_jenis_dokumen" class="col-sm-4 text-nowrap col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Kode Jenis Dokumen') }}
              </label>
              <div class="col-sm-8">
                {{-- <input type="text" class="form-control" id="kode_jenis_dokumen" name="kode_jenis_dokumen"
                  readonly style="cursor: not-allowed" value="AGKT0002"> --}}
                <input type="text" class="form-control" id="kode_jenis_dokumen" name="kode_jenis_dokumen"
                  placeholder="DKMN001" value="{{ $kodeBaru }}" readonly>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="nama_dokumen" class="col-sm-4 text-nowrap col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Nama Dokumen') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen" placeholder="KTP">
              </div>
            </div>
            <div class="mb-3 row">
              <div class="col-sm-4"></div>
              <div class="col-sm-8">
                <button type="submit" class="btn btn-primary">Tambah</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal Sunting --}}
  <div class="modal fade" id="modalSunting" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalSuntingLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-4 text-center" id="modalSuntingLabel">Sunting data jenis dokumen</h1>
          <button type="button" class="btn-close btn-close-edit-dokumen" data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form-modal-edit" method="post">
            @csrf
            @method('put')
            <div class="mb-3 row">
              <label for="kode_jenis_dokumen" class="col-sm-4 text-nowrap col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Kode Jenis Dokumen') }}
              </label>
              <div class="col-sm-8">
                {{-- <input type="text" class="form-control" id="kode_jenis_dokumen" name="kode_jenis_dokumen"
                  readonly style="cursor: not-allowed" value="AGKT0002"> --}}
                <input type="text" class="form-control" id="kode_jenis_dokumen_edit" name="kode_jenis_dokumen"
                  placeholder="DKMN001" readonly>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="nama_dokumen" class="col-sm-4 text-nowrap col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Nama Dokumen') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="nama_dokumen_edit" name="nama_dokumen"
                  placeholder="KTP">
              </div>
            </div>
            <div class="mb-3 row">
              <div class="col-sm-4"></div>
              <div class="col-sm-8">
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <button type="button" class="btn btn-danger btn-cancel-edit-dokumen"
                  data-bs-dismiss="modal">Batal</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal Hapus --}}
  <div class="modal fade" id="modalHapus" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalHapusLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header border-0 border-bottom-0">
          <h1 class="modal-title fs-4 text-center" id="modalHapusLabel">Hapus data jenis dokumen?</h1>
          <button type="button" class="btn-close btn-close-hapus-dokumen" data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-footer border-0 border-top-0">
          <form class="form-modal-delete" method="post">
            @csrf
            @method('delete')
            <button type="button" class="btn btn-secondary btn-cancel-hapus-dokumen"
              data-bs-dismiss="modal">Batal</button>
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
          const formModalDelete = document.querySelector('.modal .form-modal-delete');
          const btnCancel = document.querySelector('.modal .btn-cancel-hapus-dokumen');
          const btnClose = document.querySelector('.modal .btn-close-hapus-dokumen');
          const kodeDokumen = btn.dataset.kodeDokumen;
          const route = "{{ route('admin.dokumen.delete', ':kodeDokumen') }}";
          formModalDelete.setAttribute('action', route.replace(':kodeDokumen', kodeDokumen));
          btnCancel.addEventListener('click', () => formModalDelete.removeAttribute('action'));
          btnClose.addEventListener('click', () => formModalDelete.removeAttribute('action'));
        });
      });

      const btnEdit = document.querySelectorAll('.btn-edit');
      btnEdit.forEach(btn => {
        btn.addEventListener('click', () => {
          const formModalEdit = document.querySelector('.modal .form-modal-edit');
          const btnCancel = document.querySelector('.modal .btn-cancel-edit-dokumen');
          const btnClose = document.querySelector('.modal .btn-close-edit-dokumen');
          const kodeDokumen = btn.dataset.kodeDokumen;
          const route = "{{ route('admin.dokumen.update', ':kodeDokumen') }}";

          fetch(("{{ route('admin.dokumen.detail', ':kodeDokumen') }}").replace(':kodeDokumen', kodeDokumen))
            .then(res => res.json())
            .then(res => {
              const {
                data
              } = res;
              document.getElementById('kode_jenis_dokumen_edit').value = data.id_jenis_dokumen;
              document.getElementById('nama_dokumen_edit').value = data.nama_dokumen;
            });
          formModalEdit.setAttribute('action', route.replace(':kodeDokumen', kodeDokumen));
          btnCancel.addEventListener('click', () => formModalEdit.removeAttribute('action'));
          btnClose.addEventListener('click', () => formModalEdit.removeAttribute('action'));
        });
      });
    </script>
  @endpush
@endsection
