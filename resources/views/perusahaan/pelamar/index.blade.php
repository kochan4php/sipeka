@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
    <h2>Data Pelamar</h2>
    {{-- <a href="{{ route('admin.alumni.create') }}" class="btn btn-primary">Tambah Data Alumni</a> --}}
  </div>

  <div class="row">
    <div class="col table-responsive">
      <div class="card table-responsive">
        <div class="card-body">
          <table class="table table-bordered border-dark table-striped mb-0">
            <thead class="table-dark">
              <tr>
                <th scope="col" class="text-nowrap text-center">No</th>
                <th scope="col" class="text-nowrap text-center">Nama Pelamar</th>
                <th scope="col" class="text-nowrap text-center">Tanggal Lahir</th>
                <th scope="col" class="text-nowrap text-center">Verifikasi Pendaftaran</th>
                <th scope="col" class="text-nowrap text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th class="text-nowrap text-center" scope="row">1</th>
                <td class="text-nowrap text-center">Layla Mayrisa</td>
                <td class="text-nowrap text-center">27-06-2001</td>
                <td class="text-nowrap text-center">Sudah</td>
                <td class="text-nowrap text-center">
                  <a href="{{ route('perusahaan.pelamar.detail') }}" class="btn btn-success btn-sm">
                    Detail
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="d-flex justify-content-between align-items-center mt-3">
            <p class="align-self-center">Showing 1 of 100</p>
            <nav aria-label="Page navigation example">
              <ul class="pagination mb-0">
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0 border-bottom-0">
        <h1 class="modal-title fs-4" id="exampleModalLabel">Detail Pelamar</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kembali"></button>
      </div>
      <div class="modal-footer border-0 border-top-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>
