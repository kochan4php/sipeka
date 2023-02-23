<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenilaianSeleksi extends Model {
    use HasFactory, HasUuids;

    /**
     * Set the table name
     *
     * @var string
     */
    protected $table = 'penilaian_seleksi';

    /**
     * Set the primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_penilaian_seleksi';

    /**
     * Set the timestamps
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_pelamar',
        'id_tahapan',
        'id_pendaftaran',
        'nilai',
        'keterangan',
        'is_lanjut'
    ];

    /**
     * Satu penilaian seleksi hanya bisa dimiliki oleh satu pelamar
     *
     * @return BelongsTo
     */
    public function pelamar(): BelongsTo {
        return $this->belongsTo(Pelamar::class, 'id_pelamar', 'id_pelamar');
    }

    /**
     * Satu penilaian seleksi hanya bisa melaksanakan satu tahapan seleksi
     *
     * @return BelongsTo
     */
    public function tahapan(): BelongsTo {
        return $this->belongsTo(TahapanSeleksi::class, 'id_tahapan', 'id_tahapan');
    }

    /**
     * Satu penilaian seleksi hanya untuk satu pendaftaran
     *
     * @return BelongsTo
     */
    public function pendaftaran(): BelongsTo {
        return $this->belongsTo(PendaftaranLowongan::class, 'id_pendaftaran', 'id_pendaftaran');
    }

    /**
     * Scope untuk menampilkan penilaian seleksi berdasarkan tahapan seleksi saat ini
     *
     * @param Builder $q
     * @param int $id_tahapan
     * @return void
     */
    public function scopeCurrentStage(Builder $q, $id_tahapan): void {
        $q->where('id_tahapan', $id_tahapan);
    }

    /**
     * Scope untuk menampilkan penilaian seleksi berdasarkan pendaftaran yang sudah diverifikasi
     *
     * @param Builder $q
     * @param int $id_tahapan
     * @return void
     */
    public function scopeHasVerified(Builder $q): void {
        $q->whereRelation('pendaftaran', 'verifikasi', '=', 'Sudah');
    }

    /**
     * Scope untuk menampilkan penilaian seleksi berdasarkan pendaftaran yang belum diverifikasi
     *
     * @param Builder $q
     * @param int $id_tahapan
     * @return void
     */
    public function scopeNotYetVerified(Builder $q): void {
        $q->whereRelation('pendaftaran', 'verifikasi', '=', 'Belum');
    }

    /**
     * Scope untuk menampilkan penilaian seleksi yang tidak lulus tahapan seleksi
     *
     * @param Builder $q
     * @param int $id_tahapan
     * @return void
     */
    public function scopeNotPassSelectionStage(Builder $q): void {
        $q->where('nilai', '<', 80)
            ->where('keterangan', '=', 'Gagal')
            ->where('is_lanjut', '=', 'Tidak');
    }

    /**
     * Scope untuk menampilkan penilaian seleksi yang lulus tahapan seleksi
     *
     * @param Builder $q
     * @param int $id_tahapan
     * @return void
     */
    public function scopePassSelectionStage(Builder $q): void {
        $q->where('nilai', '>=', 80)
            ->where('keterangan', '=', 'Lulus')
            ->where('is_lanjut', '=', 'Ya');
    }
}
