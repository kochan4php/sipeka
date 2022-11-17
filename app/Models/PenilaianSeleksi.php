<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenilaianSeleksi extends Model
{
  use HasFactory;

  // kasih tau tabel yang ada di databasenya
  protected $table = 'penilaian_seleksi';

  // kasih tau primary key yang ada di tabel yang bersangkutan
  protected $primaryKey = 'id_penilaian_seleksi';

  // set timestamps menjadi false, karena kalau pakai model otomatis dia memasukkan timestamps juga
  public $timestamps = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'id_pelamar',
    'id_tahapan',
    'id_pendaftaran',
    'nilai',
    'keterangan',
    'is_lanjut'
  ];

  public function pelamar(): BelongsTo
  {
    return $this->belongsTo(Pelamar::class, 'id_pelamar', 'id_pelamar');
  }

  public function tahapan(): BelongsTo
  {
    return $this->belongsTo(TahapanSeleksi::class, 'id_tahapan', 'id_tahapan');
  }

  public function pendaftaran(): BelongsTo
  {
    return $this->belongsTo(PendaftaranLowongan::class, 'id_pendaftaran', 'id_pendaftaran');
  }
}
