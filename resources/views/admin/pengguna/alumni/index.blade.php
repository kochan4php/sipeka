@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
    <h2>Data Alumni</h2>
    <a href="{{ route('admin.alumni.create') }}" class="btn btn-primary">Tambah Data Alumni</a>
  </div>

  @if (session()->has('sukses'))
    <div class="row">
      <div class="col">
        <div class="fs-6 alert alert-success alert-dismissible fade show">
          {{ session('sukses') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    </div>
  @endif

  @if (session()->has('error'))
    <div class="row">
      <div class="col">
        <div class="fs-6 alert alert-danger alert-dismissible fade show">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    </div>
  @endif

  <div class="row">
    <div class="col table-responsive">
      <div class="card table-responsive">
        <div class="card-body">
          <table class="table table-bordered border-secondary border-1 table-striped mb-0">
            <thead class="table-dark">
              <tr>
                <th scope="col" class="text-nowrap text-center">No</th>
                <th scope="col" class="text-nowrap text-center">Nama Alumni</th>
                <th scope="col" class="text-nowrap text-center">Kode Alumni</th>
                <th scope="col" class="text-nowrap text-center">Tahun Angkatan</th>
                <th scope="col" class="text-nowrap text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($alumni as $item)
                <tr>
                  <th class="text-nowrap text-center" scope="row">{{ $loop->iteration }}</th>
                  <td class="text-nowrap text-center">{{ $item->nama_lengkap }}</td>
                  <td class="text-nowrap text-center">{{ $item->nis }}</td>
                  <td class="text-nowrap text-center">{{ $item->angkatan_tahun }}</td>
                  <td class="text-nowrap text-center">
                    <div class="btn-group">
                      <a href="{{ route('admin.alumni.detail', $item->nis) }}"
                        class="btn btn-sm fw-bolder leading-1px btn-success">
                        <span><i class="fa-solid fa-circle-info fa-lg"></i></span>
                        <span>Detail</span>
                      </a>
                      <a href="{{ route('admin.alumni.edit', $item->nis) }}"
                        class="btn btn-sm fw-bolder leading-1px btn-warning">
                        <span><i class="fa-solid fa-pen-to-square fa-lg"></i></span>
                        <span>Sunting</span>
                      </a>
                      <a href="{{ route('admin.alumni.delete', $item->nis) }}"
                        class="btn btn-sm fw-bolder leading-1px btn-danger btn-delete" data-bs-toggle="modal"
                        data-bs-target="#modalHapus" data-nis="{{ $item->nis }}">
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

  {{-- Modal Hapus --}}
  <div class="modal fade" id="modalHapus" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header border-0 border-bottom-0">
          <h1 class="modal-title fs-4 text-center" id="exampleModalLabel">Hapus data alumni?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer border-0 border-top-0">
          <form class="form-modal" method="post">
            @csrf
            @method('delete')
            <button type="button" class="btn btn-secondary btn-cancel" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    const btnDelete = document.querySelectorAll('.btn-delete');
    btnDelete.forEach(btn => {
      btn.addEventListener('click', () => {
        const formModal = document.querySelector('.modal .form-modal');
        const btnCancel = document.querySelector('.modal .btn-cancel');
        const btnClose = document.querySelector('.modal .btn-close');
        const nis = btn.dataset.nis;
        const route = "{{ route('admin.alumni.delete', ':nis') }}";
        formModal.setAttribute('action', route.replace(':nis', nis));
        btnCancel.addEventListener('click', () => formModal.removeAttribute('action'));
        btnClose.addEventListener('click', () => formModal.removeAttribute('action'));
      });
    });
  </script>
@endsection
