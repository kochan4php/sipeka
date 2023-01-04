<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatPendidikan extends Model {
  use HasFactory, HasUuids;

  // kasih tau tabel yang ada di databasenya
  protected $table = 'riwayat_pendidikan';

  // kasih tau primary key yang ada di tabel yang bersangkutan
  protected $primaryKey = 'id_riwayat';

  // set timestamps menjadi false, karena kalau pakai model otomatis dia memasukkan timestamps juga
  public $timestamps = false;

  // kasih tau kalau primary key nya bukan integer AI
  public $incrementing = false;

  // kasih tau kalau primary key nya bukan bertipe integer
  protected $keyType = 'string';

  // bawa relasinya ketika di query
  protected $with = ['gelar_pendidikan'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'kualifikasi',
    'id_pelamar',
    'institut_or_universitas',
    'tahun_kelulusan',
    'informasi_tambahan'
  ];

  public function gelar_pendidikan(): BelongsTo {
    return $this->belongsTo(GelarPendidikan::class, 'kualifikasi', 'id_gelar');
  }

  public function pelamar(): BelongsTo {
    return $this->belongsTo(Pelamar::class, 'id_pelamar', 'id_pelamar');
  }
}
