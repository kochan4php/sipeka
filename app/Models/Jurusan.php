<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurusan extends Model {
    use HasFactory;

    /**
     * Set the table name
     *
     * @var string
     */
    protected $table = 'jurusan';

    /**
     * Set the primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_jurusan';

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
        'id_jurusan',
        'nama_jurusan',
        'keterangan'
    ];

    /**
     * Satu jurusan bisa dimiliki oleh banyak siswa
     *
     * @return HasMany
     */
    public function alumni(): HasMany {
        return $this->hasMany(SiswaAlumni::class, 'id_jurusan', 'id_jurusan');
    }
}
