<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PendaftaranLowongan extends Model {
  use HasFactory, HasUuids;

  // kasih tau tabel yang ada di databasenya
  protected $table = 'pendaftaran_lowongan';

  // kasih tau primary key yang ada di tabel yang bersangkutan
  protected $primaryKey = 'id_pendaftaran';

  // set timestamps menjadi false, karena kalau pakai model otomatis dia memasukkan timestamps juga
  public $timestamps = false;

  // kasih tau kalau primary key nya bukan integer AI
  public $incrementing = false;

  // kasih tau kalau primary key nya bukan bertipe integer
  protected $keyType = 'string';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'id_pelamar',
    'id_lowongan',
    'kode_pendaftaran',
    'verifikasi',
    'status_seleksi'
  ];

  public function pelamar(): BelongsTo {
    return $this->belongsTo(Pelamar::class, 'id_pelamar', 'id_pelamar');
  }

  public function lowongan(): BelongsTo {
    return $this->belongsTo(LowonganKerja::class, 'id_lowongan', 'id_lowongan');
  }

  public function tahapan_seleksi(): HasMany {
    return $this->hasMany(TahapanSeleksi::class, 'id_pendaftaran', 'id_pendaftaran');
  }

  public function penilaian_seleksi(): HasMany {
    return $this->hasMany(PenilaianSeleksi::class, 'id_pendaftaran', 'id_pendaftaran');
  }

  public function getRouteKeyName() {
    return 'id_pendaftaran';
  }
}
