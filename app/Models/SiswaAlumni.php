<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SiswaAlumni extends Model {
    use HasFactory;

    /**
     * Set the table name
     *
     * @var string
     */
    protected $table = 'siswa_alumni';

    /**
     * Set the primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_siswa';

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
        'id_angkatan',
        'id_jurusan',
        'nis',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'no_telepon',
        'alamat_tempat_tinggal',
        'foto',
        'public_foto_id',
        'is_active'
    ];

    /**
     * Get nama jurusan from relationship
     *
     * @return Attribute
     */
    protected function idJurusan(): Attribute {
        return Attribute::make(
            get: fn ($value) => Jurusan::firstWhere('id_jurusan', $value)->nama_jurusan
        );
    }

    /**
     * Get tahun angkatan from relationship
     *
     * @return Attribute
     */
    protected function idAngkatan(): Attribute {
        return Attribute::make(
            get: fn ($value) => Angkatan::firstWhere('id_angkatan', $value)->angkatan_tahun
        );
    }

    /**
     * Satu siswa alumni berperan sebagai pelamar
     *
     * @return BelongsTo
     */
    public function pelamar(): BelongsTo {
        return $this->belongsTo(Pelamar::class, 'id_pelamar', 'id_pelamar');
    }

    /**
     * Satu siswa alumni hanya memiliki satu angkatan
     *
     * @return BelongsTo
     */
    public function jurusan(): BelongsTo {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }

    /**
     * Satu siswa alumni hanya memiliki satu jurusan
     *
     * @return BelongsTo
     */
    public function angkatan(): BelongsTo {
        return $this->belongsTo(Angkatan::class, 'id_angkatan', 'id_angkatan');
    }

    /**
     * Satu siswa alumni memiliki banyak data nilai
     *
     * @return HasMany
     */
    public function dataNilai(): HasMany {
        return $this->hasMany(DataNilai::class, 'id_alumni', 'id_alumni');
    }

    /**
     * Satu siswa alumni memiliki banyak data rekomendasi lowongan yang diberikan oleh admin
     *
     * @return HasMany
     */
    public function rekomendasiLowongan(): BelongsToMany {
        return $this->belongsToMany(
            LowonganKerja::class,
            'rekomendasi_lowongan',
            'id_siswa',
            'id_lowongan',
            'id_siswa',
            'id_lowongan'
        );
    }

    /**
     * Scope filter untuk pencarian alumni
     *
     * @param Builder $q
     * @param string|null $filter
     * @return void
     */
    public function scopeFilter(Builder $q, ?string $filter): void {
        if ($filter) {
            $q->where('nis', 'LIKE', "%{$filter}%")
                ->orWhere('nama_lengkap', 'LIKE', "%{$filter}%")
                ->orWhereRelation('jurusan', 'nama_jurusan', 'LIKE', "%{$filter}%")
                ->orWhereRelation('jurusan', 'keterangan', 'LIKE', "%{$filter}%")
                ->orWhereRelation('angkatan', 'angkatan_tahun', 'LIKE', "%{$filter}%")
                ->orWhereHas('pelamar', fn ($q) => $q->whereRelation('user', 'username', 'LIKE', "%{$filter}%"));
        }
    }

    /**
     * Scope filter untuk alumni yang akunnya masih aktif
     *
     * @param Builder $q
     * @return void
     */
    public function scopeActive(Builder $q): void {
        $q->where('is_active', true);
    }
}
