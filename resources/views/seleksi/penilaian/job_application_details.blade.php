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
              @if ($item->penilaian_seleksi->firstWhere('id_tahapan', $item->id_tahapan)?->is_lanjut === 'Ya')
                <td class="text-nowrap text-center vertical-align-middle custom-font checked-tahapan">
                  <i class="fa-solid fa-check fa-lg text-success"></i>
                </td>
              @else
                <td class="text-nowrap text-center vertical-align-middle custom-font xmark-tahapan">
                  <i class="fa-solid fa-xmark fa-lg text-danger"></i>
                </td>
              @endif
              <td class="text-nowrap text-center vertical-align-middle custom-font">
                {{ $item->penilaian_seleksi->firstWhere('id_tahapan', $item->id_tahapan)?->nilai ?? __('-') }}
              </td>
              <td class="text-nowrap text-center vertical-align-middle custom-font">
                {{ $item->penilaian_seleksi->firstWhere('id_tahapan', $item->id_tahapan)?->keterangan ?? __('-') }}
              </td>
              <td class="text-nowrap text-center vertical-align-middle custom-font">
                <a href="{{ route('penilaian.seleksi.create', ['pendaftaran_lowongan' => $pendaftaranLowongan->id_pendaftaran, 'tahapan_seleksi' => $item->id_tahapan]) }}"
                  class="btn btn-primary custom-btn mark-tahapan @if ($item->penilaian_seleksi->firstWhere('id_tahapan', $item->id_tahapan)?->is_lanjut === 'Ya') d-none @endif">
                  <i class="fa-solid fa-marker fa-lg"></i>
                </a>
                <a class="btn btn-danger custom-btn mark-tahapan-edit @if ($item->penilaian_seleksi->firstWhere('id_tahapan', $item->id_tahapan)?->is_lanjut !== 'Ya') d-none @endif"
                  href="{{ route('penilaian.seleksi.edit', [
                      'pendaftaran_lowongan' => $pendaftaranLowongan->id_pendaftaran,
                      'tahapan_seleksi' => $item->id_tahapan,
                      'penilaian_seleksi' =>
                          $item->penilaian_seleksi->firstWhere('id_tahapan', $item->id_tahapan)?->id_penilaian_seleksi ?? 'false',
                  ]) }}">
                  <i class="fa-solid fa-pen-to-square fa-lg"></i>
                </a>
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
        @disabled($pendaftaranLowongan->status_seleksi === 'Lulus')>
        Luluskan Pelamar
      </button>
    </form>
  </div>

  @push('script')
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
