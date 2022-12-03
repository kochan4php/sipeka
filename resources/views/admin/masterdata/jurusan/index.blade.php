@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
    <h2>Data Jurusan</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Data
      Jurusan</button>
  </div>

  <div class="row">
    <div class="col table-responsive">
      <div class="card table-responsive">
        <div class="card-body">
          <table class="table table-bordered border-secondary border-1 table-striped mb-0">
            <thead class="table-dark">
              <tr>
                <th scope="col" class="text-nowrap text-center">No</th>
                <th scope="col" class="text-nowrap text-center">Kode Jurusan</th>
                <th scope="col" class="text-nowrap text-center">Nama Jurusan</th>
                <th scope="col" class="text-nowrap text-center">Keterangan Jurusan</th>
                <th scope="col" class="text-nowrap text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($jurusan as $item)
                <tr>
                  <th class="text-nowrap text-center" scope="row">{{ $loop->iteration }}</th>
                  <td class="text-nowrap text-center">{{ $item->id_jurusan }}</td>
                  <td class="text-nowrap text-center">{{ $item->nama_jurusan }}</td>
                  <td class="text-nowrap text-center">{{ $item->keterangan }}</td>
                  <td class="text-nowrap text-center">
                    <div class="btn-group">
                      <button type="button" data-bs-toggle="modal" data-bs-target="#modalSunting"
                        data-kode-jurusan="{{ $item->id_jurusan }}"
                        class="btn btn-sm fw-bolder leading-1px btn-warning btn-edit">
                        <span><i class="fa-solid fa-pen-to-square fa-lg"></i></span>
                        <span>Sunting</span>
                      </button>
                      <button data-kode-jurusan="{{ $item->id_jurusan }}"
                        class="btn btn-sm fw-bolder leading-1px btn-danger btn-delete" data-bs-toggle="modal"
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
          <h1 class="modal-title fs-4 text-center" id="modalTambahLabel">Tambah data jurusan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.jurusan.store') }}" method="post">
          @csrf
          <div class="mb-3 row">
            <label for="kode_jurusan" class="col-sm-4 text-nowrap col-form-label text-md-end fs-6 fs-md-5">
              {{ __('Kode Jurusam') }}
            </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="kode_jurusan" name="kode_jurusan" style="cursor: not-allowed"
                value="JRS0006">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="nama_jurusan" class="col-sm-4 text-nowrap col-form-label text-md-end fs-6 fs-md-5">
              {{ __('Nama Jurusam') }}
            </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" placeholder="RPL">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="keterangan_jurusan" class="col-sm-4 text-nowrap col-form-label text-md-end fs-6 fs-md-5">
              {{ __('Keterangan') }}
            </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="keterangan_jurusan" name="keterangan_jurusan"
                placeholder="Rekayasa Perangkat Lunak">
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
          <h1 class="modal-title fs-4 text-center" id="modalSuntingLabel">Sunting data jurusan</h1>
          <button type="button" class="btn-close btn-close-edit-dokumen" data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form-modal-edit" method="post">
            @csrf
            @method('put')
            <div class="mb-3 row">
              <label for="kode_jurusan_edit" class="col-sm-4 text-nowrap col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Kode Jurusan') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="kode_jurusan_edit" name="kode_jurusan" readonly
                  style="cursor: not-allowed" value="JRS0006">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="nama_jurusan_edit" class="col-sm-4 text-nowrap col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Nama Jurusan') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="nama_jurusan_edit" name="nama_jurusan"
                  placeholder="RPL">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="keterangan_jurusan_edit" class="col-sm-4 text-nowrap col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Keterangan') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="keterangan_jurusan_edit" name="keterangan_jurusan"
                  placeholder="Rekayasa Perangkat Lunak">
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
          <h1 class="modal-title fs-4 text-center" id="modalHapusLabel">Hapus data jurusan?</h1>
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
          const kodeJurusan = btn.dataset.kodeJurusan;
          const route = "{{ route('admin.jurusan.delete', ':kodeJurusan') }}";
          formModalDelete.setAttribute('action', route.replace(':kodeJurusan', kodeJurusan));
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
          const kodeJurusan = btn.dataset.kodeJurusan;
          const route = "{{ route('admin.jurusan.update', ':kodeJurusan') }}";

          fetch(("{{ route('admin.jurusan.detail', ':kodeJurusan') }}").replace(':kodeJurusan', kodeJurusan))
            .then(res => res.json())
            .then(data => {
              console.log(data);
              document.getElementById('kode_jurusan_edit').value = data.id_jurusan;
              document.getElementById('nama_jurusan_edit').value = data.nama_jurusan;
              document.getElementById('keterangan_jurusan_edit').value = data.keterangan;
            });
          formModalEdit.setAttribute('action', route.replace(':kodeJurusan', kodeJurusan));
          btnCancel.addEventListener('click', () => formModalEdit.removeAttribute('action'));
          btnClose.addEventListener('click', () => formModalEdit.removeAttribute('action'));
        });
      });
    </script>
  @endpush
@endsection
