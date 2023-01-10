@extends('layouts.dashboard.app')

@section('container-dashboard')
  <div class="pt-3 pb-1 mb-2">
    <h3 class="text-center">
      {{ __("Penilaian seleksi dari lamaran kerja {$namaPelamar}") }}
    </h3>
  </div>

  <div class="row">
    <div class="col table-responsive">
      <table class="table table-bordered border-secondary border-1 table-striped mb-0">
        <thead class="table-dark">
          <tr>
            <th scope="col" class="text-nowrap text-center">No</th>
            <th scope="col" class="text-nowrap text-center">Judul Tahapan</th>
            <th scope="col" class="text-nowrap text-center">Keterangan Tahapan</th>
            <th scope="col" class="text-nowrap text-center">Status Tahapan</th>
            <th scope="col" class="text-nowrap text-center">Nilai</th>
            <th scope="col" class="text-nowrap text-center">Keterangan</th>
            <th scope="col" class="text-nowrap text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pendaftaranLowongan->lowongan->tahapan_seleksi as $item)
            <tr>
              <th class="text-nowrap text-center vertical-align-middle custom-font">
                {{ $loop->iteration }}
              </th>
              <td class="text-nowrap text-center vertical-align-middle custom-font">
                {{ $item->judul_tahapan }}
              </td>
              <td class="text-nowrap text-center vertical-align-middle custom-font">
                {{ $item->ket_tahapan }}
              </td>
              @if ($item->penilaian_seleksi->where('id_pelamar', $pendaftaranLowongan->pelamar->id_pelamar)->where('id_tahapan', $item->id_tahapan)->first()?->is_lanjut === 'Ya')
                <td class="text-nowrap text-center vertical-align-middle custom-font checked-tahapan">
                  <i class="fa-solid fa-check fa-lg text-success"></i>
                </td>
              @else
                <td class="text-nowrap text-center vertical-align-middle custom-font xmark-tahapan">
                  <i class="fa-solid fa-xmark fa-lg text-danger"></i>
                </td>
              @endif
              <td class="text-nowrap text-center vertical-align-middle custom-font">
                {{ $item->penilaian_seleksi->where('id_pelamar', $pendaftaranLowongan->pelamar->id_pelamar)->where('id_tahapan', $item->id_tahapan)->first()?->nilai ?? __('-') }}
              </td>
              <td class="text-nowrap text-center vertical-align-middle custom-font">
                {{ $item->penilaian_seleksi->where('id_pelamar', $pendaftaranLowongan->pelamar->id_pelamar)->where('id_tahapan', $item->id_tahapan)->first()?->keterangan ?? __('-') }}
              </td>
              <td class="text-nowrap text-center vertical-align-middle custom-font">
                {{-- Is Lanjut --}}
                @php
                  $tahapanSeleksi = $item->penilaian_seleksi
                      ->where('id_pelamar', $pendaftaranLowongan->pelamar->id_pelamar)
                      ->where('id_tahapan', $item->id_tahapan)
                      ->first();
                  $is_lanjut = $tahapanSeleksi?->is_lanjut;
                @endphp
                {{-- Is Lanjut --}}
                <a href="{{ route('penilaian.seleksi.create', [
                    'pendaftaran_lowongan' => $pendaftaranLowongan->id_pendaftaran,
                    'tahapan_seleksi' => $item->id_tahapan,
                ]) }}"
                  class="btn btn-primary custom-btn mark-tahapan @if ($is_lanjut === 'Ya' ||
                      $is_lanjut === 'Tidak' ||
                      $pendaftaranLowongan->status_seleksi === 'Tidak' ||
                      $pendaftaranLowongan->verifikasi === 'Belum') disabled @endif">
                  <i class="fa-solid fa-marker fa-lg"></i>
                </a>
                <a class="btn btn-danger custom-btn mark-tahapan-edit @if (is_null($tahapanSeleksi) || $pendaftaranLowongan->status_seleksi === 'Tidak') disabled @endif"
                  href="{{ route('penilaian.seleksi.edit', [
                      'pendaftaran_lowongan' => $pendaftaranLowongan->id_pendaftaran,
                      'tahapan_seleksi' => $item->id_tahapan,
                      'penilaian_seleksi' => $tahapanSeleksi?->id_penilaian_seleksi ?? 'false',
                  ]) }}">
                  <i class="fa-solid fa-pen-to-square fa-lg"></i>
                </a>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modalTambahNotif"
                  data-judul-tahapan="{{ $item->judul_tahapan }}"
                  class="btn custom-btn btn-success btn-notif @if ($pendaftaranLowongan->status_seleksi === 'Lulus' ||
                      $pendaftaranLowongan->status_seleksi === 'Tidak' ||
                      $tahapanSeleksi?->keterangan === 'Lulus' ||
                      $tahapanSeleksi?->keterangan === 'Gagal') disabled @endif">
                  <i class="fa-solid fa-envelope fa-lg"></i>
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div class="d-flex gap-2 align-items-center">
    <a href="{{ route('penilaian.seleksi.index') }}" class="btn btn-primary custom-btn mt-3">
      Kembali
    </a>
    <form action="{{ route('penilaian.seleksi.pass_applicants', $pendaftaranLowongan->id_pendaftaran) }}" method="POST">
      @csrf
      <button type="submit" class="btn btn-warning custom-btn mt-3 btn-lulus" data-nama-pelamar="{{ $namaPelamar }}"
        @disabled($pendaftaranLowongan->status_seleksi === 'Lulus' ||
                $pendaftaranLowongan->status_seleksi === 'Tidak' ||
                $pendaftaranLowongan->verifikasi === 'Belum')>
        Luluskan Pelamar
      </button>
    </form>
  </div>

  <div class="modal fade" id="modalTambahNotif" tabindex="-1" aria-labelledby="labelModalTambahNotif" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-4" id="labelModalTambahNotif"></h1>
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

  @push('script')
    <script>
      const btnNotif = document.querySelectorAll('.btn-notif');
      btnNotif.forEach(btn => {
        btn.addEventListener('click', () => {
          const labelModalTambahNotif = document.getElementById('labelModalTambahNotif');
          labelModalTambahNotif.textContent =
            `Tambah Pemberitahuan untuk melaksanakan seleksi ${btn.dataset.judulTahapan}`;
        });
      });
    </script>
    <script>
      const namaPelamar = document.querySelector('.btn-lulus').dataset.namaPelamar;

      tippy('.checked-tahapan', {
        content: 'Tuntas',
        placement: 'left'
      });
      tippy('.xmark-tahapan', {
        content: 'Belum Tuntas',
        placement: 'left'
      });
      tippy('.mark-tahapan', {
        content: 'Beri Penilaian',
        placement: 'left'
      });
      tippy('.mark-tahapan-edit', {
        content: 'Edit Penilaian',
        placement: 'left'
      });
      tippy('.btn-lulus', {
        content: `Luluskan ${namaPelamar}`,
        placement: 'bottom'
      });
    </script>
  @endpush
@endsection
