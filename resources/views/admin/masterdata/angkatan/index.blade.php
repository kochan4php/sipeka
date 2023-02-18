@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
    <h2>Data Angkatan</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
      Tambah Data Angkatan
    </button>
  </div>

  <x-alert-session />

  <div class="row">
    <div class="col table-responsive">
      <div class="table-responsive pb-2">
        <table class="table table-bordered border-secondary table-striped py-2">
          <thead class="table-dark">
            <tr>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">No</th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">Kode Angkatan</th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">Tahun Angkatan</th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($angkatan as $key => $item)
              <tr>
                <th class="text-nowrap text-center vertical-align-middle custom-font" scope="row">
                  {{ $angkatan->firstItem() + $key }}
                </th>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->id_angkatan }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->angkatan_tahun }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  <div class="d-flex gap-2 align-items-center justify-content-center">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalSunting"
                      data-id-angkatan="{{ $item->id_angkatan }}" class="btn custom-btn btn-warning btn-edit">
                      <span><i class="fa-solid fa-pen-to-square fa-lg"></i></span>
                    </button>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div>{{ $angkatan->links() }}</div>
      </div>
    </div>
  </div>

  {{-- Modal Tambah --}}
  <div class="modal fade" id="modalTambah" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalTambahLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-4 text-center" id="modalTambahLabel">Tambah data angkatan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.angkatan.store') }}" method="post">
            @csrf
            <div class="mb-3 row">
              <label for="id_angkatan" class="col-sm-4 text-nowrap col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Kode Angkatan') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="id_angkatan" name="id_angkatan"
                  style="cursor: not-allowed">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="angkatan_tahun" class="col-sm-4 text-nowrap col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Tahun Angkatan') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="angkatan_tahun" name="angkatan_tahun"
                  placeholder="2021/2022" value="2021/2022">
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
          <h1 class="modal-title fs-4 text-center" id="modalSuntingLabel">Sunting data angkatan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form-modal-edit" method="post">
            @csrf
            @method('put')
            <div class="mb-3 row">
              <label for="id_angkatan" class="col-sm-4 text-nowrap col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Kode Angkatan') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="id_angkatan_edit" name="id_angkatan"
                  style="cursor: not-allowed" value="AGKT0002">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="angkatan_tahun_edit" class="col-sm-4 text-nowrap col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Tahun Angkatan') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="angkatan_tahun_edit" name="angkatan_tahun"
                  placeholder="2021/2022" value="2021/2022">
              </div>
            </div>
            <div class="mb-3 row">
              <div class="col-sm-4"></div>
              <div class="col-sm-8">
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('script')
  <script>
    const btnEdit = document.querySelectorAll('.btn-edit');
    btnEdit.forEach(btn => {
      btn.addEventListener('click', () => {
        const formModalEdit = document.querySelector('.modal .form-modal-edit');
        const btnCancel = document.querySelector('.modal .btn-cancel-edit-dokumen');
        const btnClose = document.querySelector('.modal .btn-close-edit-dokumen');
        const idAngkatan = btn.dataset.idAngkatan;
        const route = "{{ route('admin.angkatan.update', ':idAngkatan') }}";
        fetch(("{{ route('admin.angkatan.detail', ':idAngkatan') }}").replace(':idAngkatan',
            idAngkatan))
          .then(res => res.json())
          .then(data => {
            console.log(data);
            document.getElementById('id_angkatan_edit').value = data.id_angkatan;
            document.getElementById('angkatan_tahun_edit').value = data.angkatan_tahun;
          });
        formModalEdit.setAttribute('action', route.replace(':idAngkatan', idAngkatan));
        btnCancel.addEventListener('click', () => formModalEdit.removeAttribute('action'));
        btnClose.addEventListener('click', () => formModalEdit.removeAttribute('action'));
      });
    });
  </script>
@endpush
