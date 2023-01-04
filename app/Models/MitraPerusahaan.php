<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MitraPerusahaan extends Model {
  use HasFactory;

  // kasih tau tabel yang ada di databasenya
  protected $table = 'mitra_perusahaan';

  // kasih tau primary key yang ada di tabel yang bersangkutan
  protected $primaryKey = 'id_perusahaan';

  // set timestamps menjadi false, karena kalau pakai model otomatis dia memasukkan timestamps juga
  public $timestamps = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'id_user',
    'nama_perusahaan',
    'nomor_telp_perusahaan',
    'thumbnail_perusahaan',
    'logo_perusahaan',
    'deskripsi_perusahaan',
    'alamat_perusahaan'
  ];

  public function user(): BelongsTo {
    return $this->belongsTo(User::class, 'id_user', 'id_user');
  }

  public function lowongan(): HasMany {
    return $this->hasMany(LowonganKerja::class, 'id_perusahaan', 'id_perusahaan');
  }
}
