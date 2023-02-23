<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GelarPendidikan extends Model {
    use HasFactory, HasUuids;

    /**
     * Set the table name
     *
     * @var string
     */
    protected $table = 'gelar_pendidikan';

    /**
     * Set the primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_gelar';

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
        'nama_gelar'
    ];

    /**
     * Satu gelar pendidikan bisa dimiliki oleh banyak riwayat pendidikan
     *
     * @return HasMany
     */
    public function riwayat_pendidikan(): HasMany {
        return $this->hasMany(RiwayatPendidikan::class, 'kualifikasi', 'id_gelar');
    }
}
