<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LowonganKerja extends Model {
  use HasFactory;

  // kasih tau tabel yang ada di databasenya
  protected $table = 'lowongan_kerja';

  // kasih tau primary key yang ada di tabel yang bersangkutan
  protected $primaryKey = 'id_lowongan';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'id_perusahaan',
    'judul_lowongan',
    'deskripsi_lowongan',
    'tanggal_dimulai',
    'tanggal_berakhir',
    'slug',
  ];

  protected function createdAt(): Attribute {
    return Attribute::make(
      get: fn ($value) => Carbon::parse($value)->diffForHumans()
    );
  }

  public function perusahaan(): BelongsTo {
    return $this->belongsTo(MitraPerusahaan::class, 'id_perusahaan', 'id_perusahaan');
  }

  public function tahapan_seleksi(): HasMany {
    return $this->hasMany(TahapanSeleksi::class, 'id_lowongan', 'id_lowongan');
  }

  public function pendaftaran_lowongan(): HasMany {
    return $this->hasMany(PendaftaranLowongan::class, 'id_lowongan', 'id_lowongan');
  }

  public function getRouteKeyName() {
    return 'slug';
  }
}
