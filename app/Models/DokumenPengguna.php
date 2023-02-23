<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DokumenPengguna extends Model {
    use HasFactory;

    /**
     * Set the table name
     *
     * @var string
     */
    protected $table = 'dokumen_pengguna';

    /**
     * Set the primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_dokumen_pengguna';

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
        'id_jenis_dokumen',
        'nama_file',
        'public_id',
    ];

    /**
     * Get the jenis dokumen for the dokumen pengguna.
     *
     * @return BelongsTo
     */
    public function jenis_dokumen(): BelongsTo {
        return $this->belongsTo(Dokumen::class, 'id_jenis_dokumen', 'id_jenis_dokumen');
    }

    /**
     * Get the pelamar for the dokumen pengguna.
     *
     * @return BelongsTo
     */
    public function pelamar(): BelongsTo {
        return $this->belongsTo(Pelamar::class, 'id_pelamar', 'id_pelamar');
    }
}
