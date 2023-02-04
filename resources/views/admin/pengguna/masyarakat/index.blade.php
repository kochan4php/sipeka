@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-1 mb-2">
    <h2>Data Kandidat Luar</h2>
    <a href="{{ route('admin.pelamar.create') }}" class="btn btn-primary custom-btn">Tambah Data Pelamar</a>
  </div>

  <div class="row">
    <div class="col table-responsive">
      <div class="table-responsive pb-2">
        <table class="table table-bordered border-secondary table-striped py-2">
          <thead class="table-dark">
            <tr>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">No</th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">Nama Lengkap</th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">Username</th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">No. Telepon</th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle custom-font">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($masyarakat as $key => $item)
              <tr>
                <th class="text-nowrap text-center vertical-align-middle custom-font" scope="row">
                  {{ $masyarakat->firstItem() + $key }}</th>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->nama_lengkap }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->pelamar->user->username }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  {{ $item->no_telepon ?? '-' }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle custom-font">
                  <div class="d-flex gap-2 align-items-center justify-content-center">
                    <a href="{{ route('admin.pelamar.detail', $item->pelamar->user->username) }}"
                      class="btn custom-btn btn-success">
                      <span><i class="fa-solid fa-circle-info fa-lg"></i></span>
                    </a>
                    <a href="{{ route('admin.pelamar.edit', $item->pelamar->user->username) }}"
                      class="btn custom-btn btn-warning">
                      <span><i class="fa-solid fa-pen-to-square fa-lg"></i></span>
                    </a>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="fs-5 text-center">
                  <x-svg-empty-icon />
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
        <div>{{ $masyarakat->links() }}</div>
      </div>
    </div>
  </div>
@endsection
