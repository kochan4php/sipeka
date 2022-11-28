@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="row">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
      <h1>Lowongan Kerja</h1>
      <a href="{{ route('admin.alumni.create') }}" class="btn btn-primary">Tambah Lowongan Kerja</a>
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
                <tr>
                  <th class="text-nowrap text-center" scope="row">1</th>
                  <td class="text-nowrap text-center">System Analyst</td>
                  <td class="text-nowrap text-center">28-November-2022</td>
                  <td class="text-nowrap text-center">28-Desember-2022</td>
                  <td class="text-nowrap text-center">
                    <a href="/" class="btn btn-success btn-sm">
                      Detil
                    </a>
                    <a href="/" class="btn btn-warning btn-sm">
                      Sunting
                    </a>
                    <a href="/" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                      data-bs-target="#staticBackdrop">
                      Hapus
                    </a>
                  </td>
                </tr>
                <tr>
                  <th class="text-nowrap text-center" scope="row">2</th>
                  <td class="text-nowrap text-center">Project Manager</td>
                  <td class="text-nowrap text-center">28-November-2022</td>
                  <td class="text-nowrap text-center">28-Desember-2022</td>
                  <td class="text-nowrap text-center">
                    <a href="/" class="btn btn-success btn-sm">
                      Detil
                    </a>
                    <a href="/" class="btn btn-warning btn-sm">
                      Sunting
                    </a>
                    <a href="/" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                      data-bs-target="#staticBackdrop">
                      Hapus
                    </a>
                  </td>
                </tr>
                <tr>
                  <th class="text-nowrap text-center" scope="row">3</th>
                  <td class="text-nowrap text-center">Fullstack Development</td>
                  <td class="text-nowrap text-center">28-November-2022</td>
                  <td class="text-nowrap text-center">28-Desember-2022</td>
                  <td class="text-nowrap text-center">
                    <a href="/" class="btn btn-success btn-sm">
                      Detil
                    </a>
                    <a href="/" class="btn btn-warning btn-sm">
                      Sunting
                    </a>
                    <a href="/" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                      data-bs-target="#staticBackdrop">
                      Hapus
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

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1"
      aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header border-0 border-bottom-0">
            <h1 class="modal-title fs-4 text-center" id="exampleModalLabel">Hapus data alumni?</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-footer border-0 border-top-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-danger">Hapus</button>
          </div>
        </div>
      </div>
    </div>
  @endsection
