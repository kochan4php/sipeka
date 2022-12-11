@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
    <h1>Lowongan Kerja</h1>
    <a href="{{ route('lowongankerja.create') }}" class="btn btn-primary">Tambah Lowongan Kerja</a>
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
                <th scope="col" class="text-nowrap text-center">Email Perusahaan</th>
              @endcan
              <th scope="col" class="text-nowrap text-center">Tanggal Dimulai</th>
              <th scope="col" class="text-nowrap text-center">Tanggal Berakhir</th>
              <th scope="col" class="text-nowrap text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @if ($lowongan->count() > 0)
              @foreach ($lowongan as $item)
                <tr>
                  <th class="text-nowrap text-center" scope="row">{{ $loop->iteration }}</th>
                  <td class="text-nowrap text-center">{{ $item->judul_lowongan }}</td>
                  @can('admin')
                    <td class="text-nowrap text-center">{{ $item->perusahaan->nama_perusahaan }}</td>
                    <td class="text-nowrap text-center">{{ $item->perusahaan->user->email }}</td>
                  @endcan
                  <td class="text-nowrap text-center">
                    {{ \Carbon\Carbon::parse($item->tanggal_dimulai)->format('d M Y') }}
                  </td>
                  <td class="text-nowrap text-center">
                    {{ \Carbon\Carbon::parse($item->tanggal_berakhir)->format('d M Y') }}
                  </td>
                  <td class="text-nowrap text-center">
                    <div class="btn-group">
                      <a href="{{ route('lowongankerja.detail', $item->slug) }}"
                        class="btn btn-sm fw-bolder leading-1px btn-success">
                        <span><i class="fa-solid fa-circle-info fa-lg"></i></span>
                        <span>Detail</span>
                      </a>
                      <a href="{{ route('lowongankerja.edit', $item->slug) }}"
                        class="btn btn-sm fw-bolder leading-1px btn-warning">
                        <span><i class="fa-solid fa-pen-to-square fa-lg"></i></span>
                        <span>Sunting</span>
                      </a>
                      <button data-slug="{{ $item->slug }}"
                        class="btn btn-sm fw-bolder leading-1px btn-danger btn-delete" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        <span><i class="fa-solid fa-trash fa-lg"></i></span>
                        <span>Hapus</span>
                      </button>
                    </div>
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="7" class="fs-5 text-center">Data lowongan belum ada, silahkan tambahkan!</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
          const slug = btn.dataset.slug;
          const route = "{{ route('lowongankerja.delete', ':slug') }}";
          formModal.setAttribute('action', route.replace(':slug', slug));
          btnCancel.addEventListener('click', () => formModal.removeAttribute('action'));
          btnClose.addEventListener('click', () => formModal.removeAttribute('action'));
        });
      });
    </script>
  @endpush
@endsection
