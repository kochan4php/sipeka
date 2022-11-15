<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaAlumni extends Model
{
  use HasFactory;

  // kasih tau tabel yang ada di databasenya
  protected $table = 'siswa_alumni';

  // kasih tau primary key yang ada di tabel yang bersangkutan
  protected $primaryKey = 'id_siswa';

  // set timestamps menjadi false, karena kalau pakai model otomatis dia memasukkan timestamps juga
  public $timestamps = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'id_pelamar',
    'id_angkatan',
    'id_jurusan',
    'nis',
    'nama_lengkap',
    'jenis_kelamin',
    'tempat_lahir',
    'tanggal_lahir',
    'no_telepon',
    'alamat_tempat_tinggal',
    'foto'
  ];
}
