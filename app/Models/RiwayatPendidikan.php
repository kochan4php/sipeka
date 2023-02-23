<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatPendidikan extends Model {
    use HasFactory, HasUuids;

    /**
     * Set the table name
     *
     * @var string
     */
    protected $table = 'riwayat_pendidikan';

    /**
     * Set the primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_riwayat';

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
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['gelar_pendidikan'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kualifikasi',
        'id_pelamar',
        'institut_or_universitas',
        'tahun_kelulusan',
        'informasi_tambahan'
    ];

    /**
     * Satu riwayat pendidikan hanya memiliki satu gelar pendidikan
     *
     * @return BelongsTo
     */
    public function gelar_pendidikan(): BelongsTo {
        return $this->belongsTo(GelarPendidikan::class, 'kualifikasi', 'id_gelar');
    }

    /**
     * Satu riwayat pendidikan hanya bisa dimiliki oleh satu pelamar
     *
     * @return BelongsTo
     */
    public function pelamar(): BelongsTo {
        return $this->belongsTo(Pelamar::class, 'id_pelamar', 'id_pelamar');
    }
}
