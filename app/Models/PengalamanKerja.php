<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengalamanKerja extends Model {
    use HasFactory;

    // kasih tau tabel yang ada di databasenya
    protected $table = 'pengalaman_kerja';

    // kasih tau primary key yang ada di tabel yang bersangkutan
    protected $primaryKey = 'id_pengalaman';

    // set timestamps menjadi false, karena kalau pakai model otomatis dia memasukkan timestamps juga
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_pelamar',
        'id_jenis_pekerjaan',
        'judul_posisi',
        'nama_perusahaan',
        'tanggal_masuk',
        'tanggal_selesai',
        'deskripsi_pengalaman',
    ];

    public function pelamar(): BelongsTo {
        return $this->belongsTo(Pelamar::class, 'id_pelamar', 'id_pelamar');
    }

    public function jenis_pekerjaan(): BelongsTo {
        return $this->belongsTo(JenisPekerjaan::class, 'id_jenis_pekerjaan', 'id_jenis_pekerjaan');
    }
}
