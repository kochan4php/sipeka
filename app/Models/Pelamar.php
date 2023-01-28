<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pelamar extends Model {
  use HasFactory;

  // kasih tau tabel yang ada di databasenya
  protected $table = 'pelamar';

  // kasih tau primary key yang ada di tabel yang bersangkutan
  protected $primaryKey = 'id_pelamar';

  // set timestamps menjadi false, karena kalau pakai model otomatis dia memasukkan timestamps juga
  public $timestamps = false;

  protected $with = ['user'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'id_user'
  ];

  public function user(): BelongsTo {
    return $this->belongsTo(User::class, 'id_user', 'id_user');
  }

  public function alumni(): HasOne {
    return $this->hasOne(SiswaAlumni::class, 'id_pelamar', 'id_pelamar');
  }

  public function masyarakat(): HasOne {
    return $this->hasOne(Masyarakat::class, 'id_pelamar', 'id_pelamar');
  }

  public function riwayat_pendidikan(): HasMany {
    return $this->hasMany(RiwayatPendidikan::class, 'id_pelamar', 'id_pelamar');
  }

  public function pengalaman_bekerja(): HasMany {
    return $this->hasMany(PengalamanKerja::class, 'id_pelamar', 'id_pelamar');
  }

  public function pendaftaran_lowongan(): HasMany {
    return $this->hasMany(PendaftaranLowongan::class, 'id_pelamar', 'id_pelamar');
  }

  public function dokumen(): HasMany {
    return $this->hasMany(DokumenPengguna::class, 'id_pelamar', 'id_pelamar');
  }

  public function penilaian_seleksi(): HasMany {
    return $this->hasMany(PenilaianSeleksi::class, 'id_pelamar', 'id_pelamar');
  }

  public function notifikasi_seleksi(): HasMany {
    return $this->hasMany(NotifikasiSeleksi::class, 'id_pelamar', 'id_pelamar');
  }

  public function getRouteKeyName(): string {
    return 'id_pelamar';
  }
}
