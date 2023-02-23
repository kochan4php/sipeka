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
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class LowonganKerja extends Model {
    use HasFactory;

    /**
     * Set the table name
     *
     * @var string
     */
    protected $table = 'lowongan_kerja';

    /**
     * Set the primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_lowongan';

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

    /**
     * Set the created_at attribute
     *
     * @return Attribute
     */
    protected function createdAt(): Attribute {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->diffForHumans()
        );
    }

    /**
     * Satu lowongan_kerja dimiliki oleh satu perusahaan
     *
     * @return BelongsTo
     */
    public function perusahaan(): BelongsTo {
        return $this->belongsTo(MitraPerusahaan::class, 'id_perusahaan', 'id_perusahaan');
    }

    /**
     * Satu lowongan_kerja bisa memiliki banyak tahapan seleksi
     *
     * @return HasMany
     */
    public function tahapan_seleksi(): HasMany {
        return $this->hasMany(TahapanSeleksi::class, 'id_lowongan', 'id_lowongan');
    }

    /**
     * Satu lowongan_kerja bisa dimiliki oleh banyak pendaftaran_lowongan
     *
     * @return HasMany
     */
    public function pendaftaran_lowongan(): HasMany {
        return $this->hasMany(PendaftaranLowongan::class, 'id_lowongan', 'id_lowongan');
    }

    /**
     * Satu lowongan_kerja bisa memiliki banyak penilaian_seleksi melalui pendaftaran_lowongan
     *
     * @return HasManyThrough
     */
    public function penilaian_seleksi(): HasManyThrough {
        return $this->hasManyThrough(
            PenilaianSeleksi::class,
            PendaftaranLowongan::class,
            'id_lowongan', // Foreign key di table pendaftaran_lowongan
            'id_pendaftaran', // Foreign key di table penilaian_seleksi
            'id_lowongan', // Local key / Primary key di table lowongan_kerja
            'id_pendaftaran' // Local key / Primary key di table pendaftaran_lowongan
        );
    }

    /**
     * Satu lowongan_kerja hanya berlokasi di satu kantor
     *
     * @return BelongsTo
     */
    public function kantor(): BelongsTo {
        return $this->belongsTo(Kantor::class, 'lokasi_kerja', 'id_kantor');
    }

    /**
     * Set the route key name
     *
     * @return string
     */
    public function getRouteKeyName(): string {
        return 'slug';
    }

    /**
     * Scope untuk filter lowongan_kerja
     *
     * @param Builder $q
     * @param string|null $filter
     * @return void
     */
    public function scopeFilter(Builder $q, ?string $filter): void {
        if ($filter) {
            $q->where('judul_lowongan', 'LIKE', "%{$filter}%")
                ->orWhere('posisi', 'LIKE', "%{$filter}%")
                ->orWhere('estimasi_gaji', 'LIKE', "%{$filter}%")
                ->orWhereRelation('perusahaan', 'nama_perusahaan', 'LIKE', "%{$filter}%")
                ->orWhereRelation('kantor', 'wilayah_kantor', 'LIKE', "%{$filter}%")
                ->orWhereRelation('kantor', 'status_kantor', 'LIKE', "%{$filter}%");
        }
    }

    /**
     * Scope untuk filter lowongan_kerja berdasarkan status is_finished
     *
     * @param Builder $q
     * @return void
     */
    public function scopeIsFinished(Builder $q): void {
        $q->where('is_finished', true);
    }

    /**
     * Scope untuk filter lowongan_kerja berdasarkan status is_approve
     *
     * @param Builder $q
     * @return void
     */
    public function scopeHasApproved(Builder $q): void {
        $q->where('is_approve', true);
    }

    /**
     * Scope untuk filter lowongan_kerja berdasarkan status active
     *
     * @param Builder $q
     * @return void
     */
    public function scopeActive(Builder $q): void {
        $q->where('active', true);
    }

    /**
     * Scope untuk filter lowongan_kerja yang belum di approve
     *
     * @param Builder $q
     * @return void
     */
    public function scopeNotYetApproved(Builder $q): void {
        $q->whereNull('is_approve');
    }

    /**
     * Scope untuk filter lowongan_kerja yang belum di aktifkan
     *
     * @param Builder $q
     * @return void
     */
    public function scopeNotYetActive(Builder $q): void {
        $q->whereNull('active');
    }

    /**
     * Scope untuk filter lowongan_kerja yang ditolak
     *
     * @param Builder $q
     * @return void
     */
    public function scopeRejected(Builder $q): void {
        $q->where('is_approve', false);
    }

    /**
     * Scope untuk filter lowongan_kerja yang tidak aktif
     *
     * @param Builder $q
     * @return void
     */
    public function scopeNotActive(Builder $q): void {
        $q->where('active', false);
    }

    /**
     * Scope untuk filter lowongan_kerja yang sudah di approve dan aktifkan
     *
     * @param Builder $q
     * @return void
     */
    public function scopeApprovedAndActive(Builder $q): void {
        $q->where('is_approve', true)
            ->where('active', true);
    }

    /**
     * Scope untuk filter lowongan_kerja yang belum di approve dan belum di aktifkan
     *
     * @param Builder $q
     * @return void
     */
    public function scopeNotYetApprovedAndNotYetActive(Builder $q): void {
        $q->whereNull('is_approve')
            ->whereNull('active');
    }

    /**
     * Scope untuk filter lowongan_kerja yang membutuhkan persetujuan
     *
     * @param Builder $q
     * @return void
     */
    public function scopeNeedApproved(Builder $q): void {
        $q->whereNull('is_approve');
    }

    /**
     * Scope untuk filter lowongan_kerja yang memiliki tahapan_seleksi
     *
     * @param Builder $q
     * @return void
     */
    public function scopeHasTahapan(Builder $q): void {
        $q->whereHas('tahapan_seleksi');
    }
}
