<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TahapanSeleksi extends Model {
  use HasFactory, HasUuids;

  // kasih tau tabel yang ada di databasenya
  protected $table = 'tahapan_seleksi';

  // kasih tau primary key yang ada di tabel yang bersangkutan
  protected $primaryKey = 'id_tahapan';

  // set timestamps menjadi false, karena kalau pakai model otomatis dia memasukkan timestamps juga
  public $timestamps = false;

  // kasih tau kalau primary key nya bukan integer AI
  public $incrementing = false;

  // kasih tau kalau primary key nya bukan bertipe integer
  protected $keyType = 'string';

  protected $with = ['pendaftaran'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'id_lowongan',
    'judul_tahapan',
    'ket_tahapan',
    'urutan_tahapan_ke',
  ];

  public function pendaftaran(): BelongsTo {
    return $this->belongsTo(PendaftaranLowongan::class, 'id_pendaftaran', 'id_pendaftaran');
  }

  public function penilaian_seleksi(): HasMany {
    return $this->hasMany(PenilaianSeleksi::class, 'id_tahapan', 'id_tahapan');
  }

  public function getRouteKeyName() {
    return 'id_tahapan';
  }
}
