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

    // kasih tau tabel yang ada di databasenya
    protected $table = 'pendaftaran_lowongan';

    // kasih tau primary key yang ada di tabel yang bersangkutan
    protected $primaryKey = 'id_pendaftaran';

    // kasih tau kalau primary key nya bukan integer AI
    public $incrementing = false;

    // kasih tau kalau primary key nya bukan bertipe integer
    protected $keyType = 'string';

    protected $with = ['lowongan', 'pelamar'];

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

    public function pelamar(): BelongsTo {
        return $this->belongsTo(Pelamar::class, 'id_pelamar', 'id_pelamar');
    }

    public function lowongan(): BelongsTo {
        return $this->belongsTo(LowonganKerja::class, 'id_lowongan', 'id_lowongan');
    }

    public function penilaian_seleksi(): HasMany {
        return $this->hasMany(PenilaianSeleksi::class, 'id_pendaftaran', 'id_pendaftaran');
    }

    public function getRouteKeyName(): string {
        return 'id_pendaftaran';
    }

    public function scopeIsLanjut(Builder $q): void {
        $q->where('status_seleksi', '<>', 'Tidak')
            ->orWhere('status_seleksi', '=', 'Belum tuntas mengikuti seleksi');
    }

    public function scopeHasVerified(Builder $q): void {
        $q->where('verifikasi', 'Sudah');
    }

    public function scopeNotYetVerified(Builder $q): void {
        $q->where('verifikasi', 'Belum');
    }

    public function scopeIsRejected(Builder $q): void {
        $q->where('verifikasi', 'Ditolak');
    }

    public function scopeIsPassed(Builder $q): void {
        $q->where('status_seleksi', 'Lulus');
    }

    public function scopeNotPassed(Builder $q): void {
        $q->where('status_seleksi', 'Tidak');
    }

    public function scopeHaveNotYetCompletedTheSelectionProcess(Builder $q): void {
        $q->where('status_seleksi', 'Belum tuntas mengikuti seleksi');
    }
}
