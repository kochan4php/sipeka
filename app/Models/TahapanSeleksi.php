<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TahapanSeleksi extends Model {
    use HasFactory, HasUuids;

    /**
     * Set the table name
     *
     * @var string
     */
    protected $table = 'tahapan_seleksi';

    /**
     * Set the primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_tahapan';

    /**
     * Set the timestamps
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Set the incrementing
     *
     * @var boolean
     */
    public $incrementing = false;

    /**
     * Set the key type
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
        'id_lowongan',
        'judul_tahapan',
        'ket_tahapan',
        'urutan_tahapan_ke',
        'tanggal_dimulai',
        'is_approve',
        'status'
    ];

    /**
     * Satu tahapan seleksi hanya dimiliki oleh satu lowongan kerja
     *
     * @return BelongsTo
     */
    public function lowongan(): BelongsTo {
        return $this->belongsTo(LowonganKerja::class, 'id_lowongan', 'id_lowongan');
    }

    /**
     * Satu tahapan seleksi memiliki banyak penilaian seleksi yang dilakukan oleh pelamar
     *
     * @return HasMany
     */
    public function penilaian_seleksi(): HasMany {
        return $this->hasMany(PenilaianSeleksi::class, 'id_tahapan', 'id_tahapan');
    }

    /**
     * Set the route key name for the model
     *
     * @return string
     */
    public function getRouteKeyName(): string {
        return 'id_tahapan';
    }

    /**
     * Set the attribute tanggal_dimulai
     *
     * @return Attribute
     */
    protected function tanggalDimulai(): Attribute {
        return Attribute::make(
            get: fn ($value) => \Carbon\Carbon::parse($value)->format('d F Y')
        );
    }

    /**
     * Scope untuk memfilter tahapan seleksi yang belum diapprove
     *
     * @param Builder $q
     * @return void
     */
    public function scopeNeedApprove(Builder $q): void {
        $q->where('status', 'Menunggu Persetujuan Admin');
    }

    /**
     * Scope untuk memfilter tahapan seleksi sebelumnya
     *
     * @param Builder $q
     * @param TahapanSeleksi $tahapanSeleksi
     * @return void
     */
    public function scopePrevTahapan(Builder $q, TahapanSeleksi $tahapanSeleksi): void {
        $q->where('urutan_tahapan_ke', $tahapanSeleksi->urutan_tahapan_ke - 1);
    }
}
