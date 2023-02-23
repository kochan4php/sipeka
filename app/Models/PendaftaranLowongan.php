<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PendaftaranLowongan extends Model {
    use HasFactory, HasUuids;

    /**
     * Set the table name
     *
     * @var string
     */
    protected $table = 'pendaftaran_lowongan';

    /**
     * Set the primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_pendaftaran';

    /**
     * Set the timestamps
     *
     * @var boolean
     */
    public $incrementing = false;

    /**
     * Set the primary key type
     *
     * @var string
     */
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
        'status_seleksi',
        'surat_lamaran_kerja',
        'applicant_promotion'
    ];

    /**
     * Satu pendaftaran dimiliki oleh satu pelamar
     *
     * @return BelongsTo
     */
    public function pelamar(): BelongsTo {
        return $this->belongsTo(Pelamar::class, 'id_pelamar', 'id_pelamar');
    }

    /**
     * Satu pendaftaran hanya bisa mendaftar pada satu lowongan
     *
     * @return BelongsTo
     */
    public function lowongan(): BelongsTo {
        return $this->belongsTo(LowonganKerja::class, 'id_lowongan', 'id_lowongan');
    }

    /**
     * Satu pendaftaran bisa memiliki banyak penilaian seleksi yang dilakukan oleh pelamar
     *
     * @return HasMany
     */
    public function penilaian_seleksi(): HasMany {
        return $this->hasMany(PenilaianSeleksi::class, 'id_pendaftaran', 'id_pendaftaran');
    }

    /**
     * Set the route key name
     *
     * @return string
     */
    public function getRouteKeyName(): string {
        return 'id_pendaftaran';
    }

    /**
     * Scope untuk memfilter pendaftaran yang lanjut ke tahap seleksi berikutnya
     *
     * @param Builder $q
     * @return void
     */
    public function scopeIsLanjut(Builder $q): void {
        $q->where('status_seleksi', '<>', 'Tidak')
            ->orWhere('status_seleksi', '=', 'Belum tuntas mengikuti seleksi');
    }

    /**
     * Scope untuk memfilter pendaftaran yang sudah diverifikasi
     *
     * @param Builder $q
     * @return void
     */
    public function scopeHasVerified(Builder $q): void {
        $q->where('verifikasi', 'Sudah');
    }

    /**
     * Scope untuk memfilter pendaftaran yang belum diverifikasi
     *
     * @param Builder $q
     * @return void
     */
    public function scopeNotYetVerified(Builder $q): void {
        $q->where('verifikasi', 'Belum');
    }

    /**
     * Scope untuk memfilter pendaftaran yang ditolak
     *
     * @param Builder $q
     * @return void
     */
    public function scopeIsRejected(Builder $q): void {
        $q->where('verifikasi', 'Ditolak');
    }

    /**
     * Scope untuk memfilter pendaftaran yang lulus tahap seleksi
     *
     * @param Builder $q
     * @return void
     */
    public function scopeIsPassed(Builder $q): void {
        $q->where('status_seleksi', 'Lulus');
    }

    /**
     * Scope untuk memfilter pendaftaran yang tidak lulus tahap seleksi
     *
     * @param Builder $q
     * @return void
     */
    public function scopeNotPassed(Builder $q): void {
        $q->where('status_seleksi', 'Tidak');
    }

    /**
     * Scope untuk memfilter pendaftaran yang belum menyelesaikan tahap seleksi
     *
     * @param Builder $q
     * @return void
     */
    public function scopeHaveNotYetCompletedTheSelectionProcess(Builder $q): void {
        $q->where('status_seleksi', 'Belum tuntas mengikuti seleksi');
    }
}
