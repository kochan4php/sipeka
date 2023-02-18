<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SiswaAlumni extends Model {
    use HasFactory;

    // kasih tau tabel yang ada di databasenya
    protected $table = 'siswa_alumni';

    // kasih tau primary key yang ada di tabel yang bersangkutan
    protected $primaryKey = 'id_siswa';

    // set timestamps menjadi false, karena kalau pakai model otomatis dia memasukkan timestamps juga
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
        'foto'
    ];

    public function pelamar(): BelongsTo {
        return $this->belongsTo(Pelamar::class, 'id_pelamar', 'id_pelamar');
    }

    public function jurusan(): BelongsTo {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }

    public function angkatan(): BelongsTo {
        return $this->belongsTo(Angkatan::class, 'id_angkatan', 'id_angkatan');
    }

    public function dataNilai(): HasMany {
        return $this->hasMany(DataNilai::class, 'id_alumni', 'id_alumni');
    }

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

    public function scopeFilter(Builder $q, ?string $filter): void {
        $q->where('nama_lengkap', 'LIKE', "%{$filter}%")
            ->orWhere('nis', 'LIKE', "%{$filter}%");
    }
}
