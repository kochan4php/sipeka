<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kantor extends Model {
    use HasFactory, HasUuids;

    /**
     * Set the table name
     *
     * @var string
     */
    protected $table = 'kantor';

    /**
     * Set the primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_kantor';

    /**
     * Set the timestamps
     *
     * @var boolean
     */
    public $incrementing = false;

    /**
     * Set the incrementing
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
        'id_perusahaan',
        'alamat_kantor',
        'wilayah_kantor',
        'status_kantor',
        'no_telp_kantor',
        'kantor_utama'
    ];

    /**
     * Satu kantor dimiliki oleh satu perusahaan
     *
     * @return BelongsTo
     */
    public function perusahaan(): BelongsTo {
        return $this->belongsTo(MitraPerusahaan::class, 'id_perusahaan', 'id_perusahaan');
    }

    /**
     * Satu kantor bisa memiliki banyak lowongan kerja
     *
     * @return HasMany
     */
    public function lowongan(): HasMany {
        return $this->hasMany(LowonganKerja::class, 'lokasi_kerja', 'id_kantor');
    }

    /**
     * Set the route key name
     *
     * @return string
     */
    public function getRouteKeyName(): string {
        return 'id_kantor';
    }

    /**
     * Scope a query to filter the data
     *
     * @param Builder $q
     * @param string|null $filter
     * @return void
     */
    public function scopeFilter(Builder $q, ?string $filter): void {
        if ($filter) {
            $q->where('wilayah_kantor', 'LIKE', "%{$filter}%")
                ->orWhere('no_telp_kantor', 'LIKE', "%{$filter}%")
                ->orWhere('status_kantor', 'LIKE', "%{$filter}%")
                ->orWhereRelation('perusahaan', 'nama_perusahaan', 'LIKE', "%{$filter}%");
        }
    }
}
