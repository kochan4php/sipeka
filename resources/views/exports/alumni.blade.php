<table>
  <thead>
    <tr>
      <th>Angkatan</th>
      <th>Nama Alumni</th>
      <th>Nis / Username</th>
      <th>Jurusan</th>
      <th>Jenis Kelamin</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($alumni as $item)
      <tr>
        <td>
          {{ $item->angkatan_tahun }}
        </td>
        <td>
          {{ $item->nama_lengkap }}
        </td>
        <td>
          {{ $item->nis ?? $item->username }}
        </td>
        <td>
          {{ $item->nama_jurusan }}
        </td>
        <td>
          {{ $item->jenis_kelamin === 'P' ? 'Perempuan' : 'Laki-laki' }}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
