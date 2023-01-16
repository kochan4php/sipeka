<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $pendaftaranLowongan->kode_pendaftaran }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <style>
    .title {
      font-style: 'Times New Roman';
    }

    body {
      background-color: #999;
    }

    @media print {
      h2 {
        page-break-before: always;
      }

      h3,
      h4 {
        page-break-after: avoid;
      }

      pre,
      blockquote {
        page-break-inside: avoid;
      }
    }

    .container-main {
      max-width: 768px;
      min-height: 150vh;
    }

    @media print {
      .container-main {
        max-width: 768px;
        min-height: 150vh;
      }
    }
  </style>
</head>

<body>
  <div class="container-main bg-white py-4 px-0">
    <div class="row w-100">
      <div class="col-5">
        <img src="{{ asset('assets/images/bkk.png') }}" alt="{{ $pendaftaranLowongan->kode_pendaftaran }}"
          width="220">
      </div>
      <div class="col-7">
        <div class="title">
          <h3>BURSA KERJA KHUSUS</h3>
          <h3>SMK NEGERI 1 KOTA BEKASI</h3>
        </div>
        <div>
          <p>
            Jl. Bintara VIII No.2, RT.005/RW.003, Bintara, Kec. Bekasi Bar., Kota Bks, Jawa Barat 17134
          </p>
        </div>
      </div>
    </div>

    <hr>

    <div class="row">
      <div class="col">
        <table class="table table-responsive">
          <tbody>
            <tr>
              <td class="border-0 custom-font text-nowrap" style="width: 30%">{{ __('Nama Pelamar') }}</td>
              <td class="border-0 custom-font">{{ __(':') }}</td>
              @if ($pendaftaranLowongan->pelamar->alumni)
                <td class="border-0 custom-font">
                  {{ __($pendaftaranLowongan->pelamar->alumni->nama_lengkap) }}
                </td>
              @else
                <td class="border-0 custom-font">
                  {{ __($pendaftaranLowongan->pelamar->masyarakat->nama_lengkap) }}
                </td>
              @endif
            </tr>
            <tr>
              <td class="border-0 custom-font text-nowrap" style="width: 30%">{{ __('Kode Pendaftaran') }}</td>
              <td class="border-0 custom-font">{{ __(':') }}</td>
              <td class="border-0 custom-font">
                {{ __($pendaftaranLowongan->kode_pendaftaran) }}
              </td>
            </tr>
            <tr>
              <td class="border-0 custom-font text-nowrap" style="width: 30%">{{ __('Tempat Lahir') }}</td>
              <td class="border-0 custom-font">{{ __(':') }}</td>
              @if ($pendaftaranLowongan->pelamar->alumni)
                <td class="border-0 custom-font">
                  {{ __($pendaftaranLowongan->pelamar->alumni->tempat_lahir) }}
                </td>
              @else
                <td class="border-0 custom-font">
                  {{ __($pendaftaranLowongan->pelamar->masyarakat->tempat_lahir) }}
                </td>
              @endif
            </tr>
            <tr>
              <td class="border-0 custom-font text-nowrap" style="width: 30%">{{ __('Tanggal Lahir') }}</td>
              <td class="border-0 custom-font">{{ __(':') }}</td>
              @if ($pendaftaranLowongan->pelamar->alumni)
                <td class="border-0 custom-font">
                  {{ __($pendaftaranLowongan->pelamar->alumni->tanggal_lahir) }}
                </td>
              @else
                <td class="border-0 custom-font">
                  {{ __($pendaftaranLowongan->pelamar->masyarakat->tanggal_lahir) }}
                </td>
              @endif
            </tr>
            <tr>
              <td class="border-0 custom-font text-nowrap" style="width: 30%">{{ __('Jenis Kelamin') }}</td>
              <td class="border-0 custom-font">{{ __(':') }}</td>
              @if ($pendaftaranLowongan->pelamar->alumni)
                <td class="border-0 custom-font">
                  @if ($pendaftaranLowongan->pelamar->alumni->jenis_kelamin === 'L')
                    {{ __('Laki-laki') }}
                  @elseif ($pendaftaranLowongan->pelamar->alumni->jenis_kelamin === 'P')
                    {{ __('Perempuan') }}
                  @endif
                </td>
              @else
                <td class="border-0 custom-font">
                <td class="border-0 custom-font">
                  @if ($pendaftaranLowongan->pelamar->masyarakat->jenis_kelamin === 'L')
                    {{ __('Laki-laki') }}
                  @elseif ($pendaftaranLowongan->pelamar->masyarakat->jenis_kelamin === 'P')
                    {{ __('Perempuan') }}
                  @endif
                </td>
                </td>
              @endif
            </tr>
            <tr>
              <td class="border-0 custom-font text-nowrap" style="width: 30%">{{ __('Alamat') }}</td>
              <td class="border-0 custom-font">{{ __(':') }}</td>
              @if ($pendaftaranLowongan->pelamar->alumni)
                <td class="border-0 custom-font">
                  {{ __($pendaftaranLowongan->pelamar->alumni->alamat_tempat_tinggal) }}
                </td>
              @else
                <td class="border-0 custom-font">
                  {{ __($pendaftaranLowongan->pelamar->masyarakat->alamat_tempat_tinggal) }}
                </td>
              @endif
            </tr>
            <tr>
              <td class="border-0 custom-font text-nowrap" style="width: 30%">{{ __('Status Verifikasi') }}</td>
              <td class="border-0 custom-font">{{ __(':') }}</td>
              <td class="border-0 custom-font">
                @if ($pendaftaranLowongan->verifikasi === 'Sudah')
                  {{ __("{$pendaftaranLowongan->verifikasi} Verifikasi") }}
                @else
                  {{ __("{$pendaftaranLowongan->verifikasi} Verifikasi") }}
                @endif
              </td>
            </tr>
            <tr>
              <td class="border-0 custom-font text-nowrap" style="width: 30%">{{ __('Lowongan Kerja') }}</td>
              <td class="border-0 custom-font">{{ __(':') }}</td>
              <td class="border-0 custom-font">
                {{ __($pendaftaranLowongan->lowongan->judul_lowongan) }}
              </td>
            </tr>
            <tr>
              <td class="border-0 custom-font text-nowrap" style="width: 30%">{{ __('Nama Perusahaan') }}</td>
              <td class="border-0 custom-font">{{ __(':') }}</td>
              <td class="border-0 custom-font">
                {{ __($pendaftaranLowongan->lowongan->perusahaan->nama_perusahaan) }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="row justify-content-end mt-5">
      <div class="col-4">
        <p>
          {{ __('Bekasi, ' . \Carbon\Carbon::parse($pendaftaranLowongan->created_at)->format('d M Y')) }}
        </p>
        <p>
          Pendaftar
        </p>
        <br />
        <br />
        <br />
        <p class="fw-bold">
          @if ($pendaftaranLowongan->pelamar->alumni)
            {{ __($pendaftaranLowongan->pelamar->alumni->nama_lengkap) }}
          @else
            {{ __($pendaftaranLowongan->pelamar->masyarakat->nama_lengkap) }}
          @endif
        </p>
      </div>
    </div>
  </div>

  <script>
    window.onload = () => {
      window.print();
      window.close();
    }
  </script>
</body>

</html>
