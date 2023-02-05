<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class MitraPerusahaan extends Model {
  use HasFactory;

  // kasih tau tabel yang ada di databasenya
  protected $table = 'mitra_perusahaan';

  // kasih tau primary key yang ada di tabel yang bersangkutan
  protected $primaryKey = 'id_perusahaan';

  // set timestamps menjadi false, karena kalau pakai model otomatis dia memasukkan timestamps juga
  public $timestamps = false;

  protected $with = ['user'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'id_user',
    'nama_perusahaan',
    'nomor_telp_perusahaan',
    'foto_sampul_perusahaan',
    'logo_perusahaan',
    'kategori_perusahaan',
    'deskripsi_perusahaan',
    'is_blocked'
  ];

  public function user(): BelongsTo {
    return $this->belongsTo(User::class, 'id_user', 'id_user');
  }

  public function lowongan(): HasMany {
    return $this->hasMany(LowonganKerja::class, 'id_perusahaan', 'id_perusahaan');
  }

  public function pendaftaran_lowongan(): HasManyThrough {
    return $this->hasManyThrough(
      PendaftaranLowongan::class,
      LowonganKerja::class,
      'id_perusahaan',
      'id_lowongan',
      'id_perusahaan',
      'id_lowongan'
    );
  }

  public function kantor(): HasMany {
    return $this->hasMany(Kantor::class, 'id_perusahaan', 'id_perusahaan');
  }

  public function namaPerusahaan(): Attribute {
    return Attribute::make(
      get: fn ($value) => "{$this->jenis_perusahaan}. {$value}"
    );
  }
}
