@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
    <h2>Data Angkatan</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
      Tambah Data Angkatan
    </button>
  </div>

  <div class="row">
    <div class="col table-responsive">
      <div class="card table-responsive">
        <div class="card-body">
          <table class="table table-bordered border-secondary border-1 table-striped mb-0">
            <thead class="table-dark">
              <tr>
                <th scope="col" class="text-nowrap text-center">No</th>
                <th scope="col" class="text-nowrap text-center">Kode Angkatan</th>
                <th scope="col" class="text-nowrap text-center">Tahun Angkatan</th>
                <th scope="col" class="text-nowrap text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($angkatan as $item)
                <tr>
                  <th class="text-nowrap text-center" scope="row">{{ $loop->iteration }}</th>
                  <td class="text-nowrap text-center">{{ $item->id_angkatan }}</td>
                  <td class="text-nowrap text-center">{{ $item->angkatan_tahun }}</td>
                  <td class="text-nowrap text-center">
                    <div class="btn-group">
                      <button type="button" data-bs-toggle="modal" data-bs-target="#modalSunting"
                        data-id-jurusan="{{ $item->id_angkatan }}" class="btn btn-sm fw-bolder leading-1px btn-warning">
                        <span><i class="fa-solid fa-pen-to-square fa-lg"></i></span>
                        <span>Sunting</span>
                      </button>
                      <a href="{{ route('admin.angkatan.detail', $item->id_angkatan) }}"
                        class="btn btn-sm fw-bolder leading-1px btn-danger" data-bs-toggle="modal"
                        data-bs-target="#modalHapus">
                        <span><i class="fa-solid fa-trash fa-lg"></i></span>
                        <span>Hapus</span>
                      </a>
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
          <h1 class="modal-title fs-4 text-center" id="modalTambahLabel">Tambah data angkatan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.angkatan.store') }}" method="post">
            @csrf
            <div class="mb-3 row">
              <label for="kode_angkatan" class="col-sm-4 text-nowrap col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Kode Angkatan') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="kode_angkatan" name="kode_angkatan"
                  style="cursor: not-allowed" value="AGKT0002">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tahun_angkatan" class="col-sm-4 text-nowrap col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Tahun Angkatan') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="tahun_angkatan" name="tahun_angkatan"
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
          <form action="{{ route('admin.angkatan.update', 'AGKT0002') }}" method="post">
            @csrf
            @method('put')
            <div class="mb-3 row">
              <label for="kode_angkatan" class="col-sm-4 text-nowrap col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Kode Angkatan') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="kode_angkatan" name="kode_angkatan" disabled readonly
                  style="cursor: not-allowed" value="AGKT0002">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tahun_angkatan" class="col-sm-4 text-nowrap col-form-label text-md-end fs-6 fs-md-5">
                {{ __('Tahun Angkatan') }}
              </label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="tahun_angkatan" name="tahun_angkatan"
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

  {{-- Modal Hapus --}}
  <div class="modal fade" id="modalHapus" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalHapusLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header border-0 border-bottom-0">
          <h1 class="modal-title fs-4 text-center" id="modalHapusLabel">Hapus data angkatan?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer border-0 border-top-0">
          <form action="{{ route('admin.angkatan.delete', 'AGKT0001') }}" method="post">
            @csrf
            @method('delete')
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
