@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="row">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
      <h1>Lowongan Kerja</h1>
      <a href="{{ route('perusahaan.lowongankerja.create') }}" class="btn btn-primary">Tambah Lowongan Kerja</a>
    </div>
    <div class="row">
      <div class="col table-responsive">
        <div class="card table-responsive">
          <div class="card-body">
            <table class="table table-bordered border-dark table-striped mb-0">
              <thead class="table-dark">
                <tr>
                  <th scope="col" class="text-nowrap text-center">No</th>
                  <th scope="col" class="text-nowrap text-center">Judul Lowongan</th>
                  <th scope="col" class="text-nowrap text-center">Tanggal Dimulai</th>
                  <th scope="col" class="text-nowrap text-center">Tanggal Berakhir</th>
                  <th scope="col" class="text-nowrap text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @if ($lowongan->count() > 0)
                  @foreach ($lowongan as $l)
                    <tr>
                      <th class="text-nowrap text-center" scope="row">{{ $loop->iteration }}</th>
                      <td class="text-nowrap text-center">{{ $l->judul_lowongan }}</td>
                      <td class="text-nowrap text-center">{{ $l->tanggal_dimulai }}</td>
                      <td class="text-nowrap text-center">{{ $l->tanggal_berakhir }}</td>
                      <td class="text-nowrap text-center">
                        <a href="{{ route('perusahaan.lowongankerja.detail', $l->id_lowongan) }}"
                          class="btn btn-success btn-sm">
                          Detail
                        </a>
                        <a href="{{ route('perusahaan.lowongankerja.edit', $l->id_lowongan) }}"
                          class="btn btn-warning btn-sm">
                          Sunting
                        </a>
                        <button data-id-lowongan="{{ $l->id_lowongan }}" class="btn btn-danger btn-sm btn-delete"
                          data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          Hapus
                        </button>
                      </td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="5" class="fs-5 text-center">Data lowongan belum ada, silahkan tambahkan!</td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="row gap-3 gap-md-0 my-3">
      <div class="col-md-6 col-lg-4 mb-md-3 float-right">
        <div class="card text-bg-info">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <span class="fs-2 fw-bold leading-1px">{{ __('3') }}</span>
              <span>
                <i class="fa-solid fa-magnifying-glass" style="font-size: 3rem"></i>
              </span>
            </div>
            <div class="mt-4">
              <h4>Jumlah Lowongan</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1"
      aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header border-0 border-bottom-0">
            <h1 class="modal-title fs-4 text-center" id="exampleModalLabel">Hapus data lowongan?</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-footer border-0 border-top-0">
            <form method="post" class="form-modal">
              @csrf
              @method('delete')
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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
            const idLowongan = btn.dataset.idLowongan;
            const route = "{{ route('perusahaan.lowongankerja.delete', ':idLowongan') }}";
            formModal.setAttribute('action', route.replace(':idLowongan', idLowongan));
            btnCancel.addEventListener('click', () => formModal.removeAttribute('action'));
            btnClose.addEventListener('click', () => formModal.removeAttribute('action'));
          });
        });
      </script>
    @endpush
  @endsection
