<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pelamar extends Model {
    use HasFactory;

    /**
     * Set the table name
     *
     * @var string
     */
    protected $table = 'pelamar';

    /**
     * Set the primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_pelamar';

    /**
     * Set the timestamps
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Eager load the user relationship
     *
     * @var array<int, string>
     */
    protected $with = ['user'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user'
    ];

    /**
     * Satu user berperan sebagai pelamar
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Satu pelamar berperan sebagai siswa alumni
     *
     * @return HasOne
     */
    public function alumni(): HasOne {
        return $this->hasOne(SiswaAlumni::class, 'id_pelamar', 'id_pelamar');
    }

    /**
     * Satu pelamar berperan sebagai masyarakat
     *
     * @return HasOne
     */
    public function masyarakat(): HasOne {
        return $this->hasOne(Masyarakat::class, 'id_pelamar', 'id_pelamar');
    }

    /**
     * Satu pelamar bisa memiliki banyak riwayat pendidikan
     *
     * @return HasMany
     */
    public function riwayat_pendidikan(): HasMany {
        return $this->hasMany(RiwayatPendidikan::class, 'id_pelamar', 'id_pelamar');
    }

    /**
     * Satu pelamar bisa memiliki banyak pengalaman bekerja
     *
     * @return HasMany
     */
    public function pengalaman_bekerja(): HasMany {
        return $this->hasMany(PengalamanKerja::class, 'id_pelamar', 'id_pelamar');
    }

    /**
     * Satu pelamar bisa mendaftar pada banyak lowongan
     *
     * @return HasMany
     */
    public function pendaftaran_lowongan(): HasMany {
        return $this->hasMany(PendaftaranLowongan::class, 'id_pelamar', 'id_pelamar');
    }

    /**
     * Satu pelamar bisa memiliki banyak dokumen
     *
     * @return HasMany
     */
    public function dokumen(): HasMany {
        return $this->hasMany(DokumenPengguna::class, 'id_pelamar', 'id_pelamar');
    }

    /**
     * Satu pelamar bisa melaksanakan banyak penilaian seleksi
     *
     * @return HasMany
     */
    public function penilaian_seleksi(): HasMany {
        return $this->hasMany(PenilaianSeleksi::class, 'id_pelamar', 'id_pelamar');
    }

    /**
     * Set the route key name
     *
     * @return string
     */
    public function getRouteKeyName(): string {
        return 'id_pelamar';
    }
}
