<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

  public function jenis_dokumen(): BelongsTo
  {
    return $this->belongsTo(Dokumen::class, 'id_jenis_dokumen', 'id_jenis_dokumen');
  }

  public function pelamar(): BelongsTo
  {
    return $this->belongsTo(Pelamar::class, 'id_pelamar', 'id_pelamar');
  }
}
