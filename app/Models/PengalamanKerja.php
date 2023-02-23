<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengalamanKerja extends Model {
    use HasFactory;

    /**
     * Set the table name
     *
     * @var string
     */
    protected $table = 'pengalaman_kerja';

    /**
     * Set the primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_pengalaman';

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
        'id_jenis_pekerjaan',
        'judul_posisi',
        'nama_perusahaan',
        'tanggal_masuk',
        'tanggal_selesai',
        'deskripsi_pengalaman',
    ];

    /**
     * Satu pengalaman kerja dimiliki oleh satu pelamar
     *
     * @return BelongsTo
     */
    public function pelamar(): BelongsTo {
        return $this->belongsTo(Pelamar::class, 'id_pelamar', 'id_pelamar');
    }
}
