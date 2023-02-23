<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dokumen extends Model {
    use HasFactory;

    /**
     * Set the table name
     *
     * @var string
     */
    protected $table = 'dokumen';

    /**
     * Set the primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_jenis_dokumen';

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
        'id_jenis_dokumen',
        'nama_dokumen'
    ];

    /**
     * Get the dokumen pengguna for the dokumen.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dokumen_pengguna(): HasMany {
        return $this->hasMany(DokumenPengguna::class, 'id_jenis_dokumen', 'id_jenis_dokumen');
    }

    /**
     * Get the route key name
     *
     * @return string
     */
    public function getRouteKeyName(): string {
        return 'id_jenis_dokumen';
    }
}
