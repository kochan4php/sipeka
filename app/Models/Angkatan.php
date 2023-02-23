<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Angkatan extends Model {
    use HasFactory;

    /**
     * Set the table name
     *
     * @var string
     */
    protected $table = 'angkatan';

    /**
     * Set the primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_angkatan';

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
        'id_angkatan',
        'angkatan_tahun'
    ];

    /**
     * Get the alumni for the angkatan.
     *
     * @return HasMany
     */
    public function alumni(): HasMany {
        return $this->hasMany(SiswaAlumni::class, 'id_angkatan', 'id_angkatan');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string {
        return 'id_angkatan';
    }
}
