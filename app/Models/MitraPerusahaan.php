<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class MitraPerusahaan extends Model {
    use HasFactory;

    /**
     * Set the table name
     *
     * @var string
     */
    protected $table = 'mitra_perusahaan';

    /**
     * Set the primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_perusahaan';

    /**
     * Set the timestamps
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Eager load relationships
     *
     * @var array<int, string>
     */
    protected $with = ['user', 'kantor'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'nama_perusahaan',
        'nomor_telp_perusahaan',
        'foto_sampul_perusahaan',
        'logo_perusahaan',
        'kategori_perusahaan',
        'deskripsi_perusahaan',
        'is_blocked'
    ];

    /**
     * Satu user berperan sebagai mitra perusahaan
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Satu perusahaan memiliki banyak lowongan kerja
     *
     * @return HasMany
     */
    public function lowongan(): HasMany {
        return $this->hasMany(LowonganKerja::class, 'id_perusahaan', 'id_perusahaan');
    }

    /**
     * Satu lowongan_kerja yang dimiliki oleh perusahaan bisa memiliki banyak pendaftaran_lowongan
     *
     * @return HasManyThrough
     */
    public function pendaftaran_lowongan(): HasManyThrough {
        return $this->hasManyThrough(
            PendaftaranLowongan::class,
            LowonganKerja::class,
            'id_perusahaan',
            'id_lowongan',
            'id_perusahaan',
            'id_lowongan'
        );
    }

    /**
     * Satu perusahaan memiliki banyak kantor
     *
     * @return HasMany
     */
    public function kantor(): HasMany {
        return $this->hasMany(Kantor::class, 'id_perusahaan', 'id_perusahaan');
    }

    /**
     * Get the nama_perusahaan attribute
     *
     * @return Attribute
     */
    protected function namaPerusahaan(): Attribute {
        return Attribute::make(
            get: fn ($value) => "{$this->jenis_perusahaan}. {$value}"
        );
    }

    /**
     * Scope filter untuk pencarian
     *
     * @param Builder $q
     * @param string|null $filter
     * @return void
     */
    public function scopeFilter(Builder $q, ?string $filter): void {
        if ($filter) {
            $q->where('nama_perusahaan', 'LIKE', "%{$filter}%")
                ->orWhere('nomor_telp_perusahaan', 'LIKE', "%{$filter}%")
                ->orWhere('kategori_perusahaan', 'LIKE', "%{$filter}%")
                ->orWhereRelation('user', 'email', 'LIKE', "%{$filter}%")
                ->orWhereRelation('user', 'username', 'LIKE', "%{$filter}%");
        }
    }

    /**
     * Scope untuk menampilkan perusahaan yang tidak diblokir
     *
     * @param Builder $q
     * @return void
     */
    public function scopeNonBlocked(Builder $q): void {
        $q->where('is_blocked', false);
    }
}
