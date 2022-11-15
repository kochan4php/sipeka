<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPengguna extends Model
{
  use HasFactory;

  // kasih tau tabel yang ada di databasenya
  protected $table = 'dokumen_pengguna';

  // kasih tau primary key yang ada di tabel yang bersangkutan
  protected $primaryKey = 'id_dokumen_pengguna';

  // set timestamps menjadi false, karena kalau pakai model otomatis dia memasukkan timestamps juga
  public $timestamps = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'id_pelamar',
    'id_jenis_dokumen',
    'nama_file'
  ];
}
