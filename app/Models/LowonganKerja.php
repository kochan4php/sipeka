<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

  protected $with = ['perusahaan', 'kantor'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'id_perusahaan',
    'id_jenis_pekerjaan',
    'judul_lowongan',
    'posisi',
    'estimasi_gaji',
    'deskripsi_lowongan',
    'tanggal_berakhir',
    'slug',
    'active',
    'lokasi_kerja',
    'banner',
    'is_approve',
    'is_finished'
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

  public function kantor(): BelongsTo {
    return $this->belongsTo(Kantor::class, 'lokasi_kerja', 'id_kantor');
  }

  public function getRouteKeyName(): string {
    return 'slug';
  }

  public function scopeApprovedAndActive(Builder $q): void {
    $q->where('is_approve', true)
      ->where('active', true)
      ->latest();
  }

  public function scopeNotYetApprovedAndNotYetActive(Builder $q): void {
    $q->where('is_approve', null)
      ->where('active', null)
      ->latest();
  }

  public function scopeNeedApproved(Builder $q): void {
    $q->whereNull('is_approve');
  }

  public function scopeHasTahapan(Builder $q): void {
    $q->whereHas('tahapan_seleksi');
  }
}
