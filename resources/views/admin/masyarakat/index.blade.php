@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
    <h2>Data Masyarakat</h2>
    <a href="{{ route('admin.pelamar.create') }}" class="btn btn-primary">Tambah Data Pelamar</a>
  </div>

  <div class="row">
    <div class="col table-responsive">
      <div class="card table-responsive">
        <div class="card-body">
          <table class="table table-bordered border-secondary border-1 table-striped mb-0">
            <thead class="table-dark">
              <tr>
                <th scope="col" class="text-nowrap text-center">No</th>
                <th scope="col" class="text-nowrap text-center">Nama Lengkap</th>
                <th scope="col" class="text-nowrap text-center">Tanggal Lahir</th>
                <th scope="col" class="text-nowrap text-center">No. Telepon</th>
                <th scope="col" class="text-nowrap text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th class="text-nowrap text-center" scope="row">1</th>
                <td class="text-nowrap text-center">Layla Mayrisa</td>
                <td class="text-nowrap text-center">20 May 2005</td>
                <td class="text-nowrap text-center">083806114303</td>
                <td class="text-nowrap text-center">
                  <div class="btn-group">
                    <a href="{{ route('admin.pelamar.detail', 'layla-mayrisa') }}" class="btn btn-success">
                      Detail
                    </a>
                    <a href="{{ route('admin.pelamar.edit', 'layla-mayrisa') }}" class="btn btn-warning">
                      Sunting
                    </a>
                    <a href="{{ route('admin.pelamar.detail', 'layla-mayrisa') }}" class="btn btn-danger"
                      data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                      Hapus
                    </a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
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
@endsection

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0 border-bottom-0">
        <h1 class="modal-title fs-4 text-center" id="exampleModalLabel">Hapus data pelamar?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer border-0 border-top-0">
        <form action="{{ route('admin.pelamar.delete', 'layla-mayrisa') }}" method="post">
          @csrf
          @method('delete')
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
