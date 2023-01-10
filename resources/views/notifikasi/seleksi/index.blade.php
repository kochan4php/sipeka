@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="pt-3 pb-1 mb-2">
    <h3 class="text-center">Pemberitahuan Seleksi dan Hasil Seleksi untuk {{ $dataPelamar->nama_lengkap }}</h3>
  </div>

  <x-alert-session />

  <div class="row">
    <div class="col table-responsive">
      <div class="table-responsive pb-2">
        <table class="table table-bordered border-secondary border-1 table-striped mb-0">
          <thead class="table-dark">
            <tr>
              <th scope="col"
                class="text-nowrap vertical-align-middle d-flex gap-2 align-items-center justify-content-center">
                <span>
                  No
                </span>
                <span>
                  <button type="button" class="text-white text-decoration-none p-2 bg-transparent border-0"
                    data-bs-toggle="modal" data-bs-target="#modalPetunjuk">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                      class="bi bi-question-circle" viewBox="0 0 16 16">
                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                      <path
                        d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                    </svg>
                  </button>
                </span>
              </th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle">Nama Pelamar</th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle">Pesan</th>
              <th scope="col" class="text-nowrap text-center vertical-align-middle">Aksi</th>
            </tr>
          </thead>
          <tbody class="custom-font">
            @forelse ($notifikasiSeleksi as $item)
              <tr>
                <td class="text-nowrap text-center vertical-align-middle">
                  {{ $loop->iteration }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle">
                  {{ $dataPelamar->nama_lengkap }}
                </td>
                <td class="vertical-align-middle">
                  {{ $item->pesan }}
                </td>
                <td class="text-nowrap text-center vertical-align-middle">
                  {{-- <button type="button" class="btn custom-btn btn-danger btn-delete" data-bs-toggle="modal"
                    data-bs-target="#modalHapus" data-id-pelamar="{{ $item->pelamar->id_pelamar }}">
                    <span><i class="fa-solid fa-trash fa-lg"></i></span>
                  </button> --}}
                  <form
                    action="{{ route('notifikasi.seleksi.destroy', [
                        'pelamar' => $dataPelamar->pelamar->id_pelamar,
                        'notifikasi_seleksi' => $item->id_notifikasi_seleksi,
                    ]) }}"
                    method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn custom-btn btn-danger btn-delete"
                      onclick="return confirm('Hapus data pemberitahuan ini?')">
                      <span><i class="fa-solid fa-trash fa-lg"></i></span>
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <td class="text-nowrap text-center vertical-align-middle" colspan="4">
                Belum ada pemberitahuan untuk {{ $dataPelamar->nama_pelamar }}
              </td>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="d-flex flex-column flex-lg-row gap-2">
        <a href="{{ $urlPrev }}" class="btn btn-primary custom-font custom-btn mt-3">
          Kembali Ke Sebelumnya
        </a>
        <a href="{{ route('penilaian.seleksi.index') }}" class="btn btn-primary custom-font custom-btn mt-3">
          Kembali Secara Paksa
        </a>
        <button type="button" data-bs-toggle="modal" data-bs-target="#modalTambahNotif"
          class="btn btn-primary custom-font custom-btn mt-3">
          Tambah pemberitahuan untuk pelamar
        </button>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalTambahNotif" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pemberitahuan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('notifikasi.seleksi.store', $dataPelamar->pelamar->id_pelamar) }}" method="post"
          class="custom-font">
          @csrf
          <div class="modal-body">
            <div class="form-floating">
              <textarea class="form-control" name="pesan" id="pesan" style="height: 100px"></textarea>
              <label for="pesan">Pesan</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="custom-btn btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="custom-btn btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
