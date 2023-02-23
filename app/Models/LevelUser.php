<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LevelUser extends Model {
    use HasFactory;

    /**
     * Set the table name
     *
     * @var string
     */
    protected $table = 'level_user';

    /**
     * Set the primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_level';

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
        'id_level',
        'nama_level'
    ];

    /**
     * Satu level user bisa dimiliki oleh banyak user
     *
     * @return HasMany
     */
    public function users(): HasMany {
        return $this->hasMany(User::class, 'id_level', 'id_level');
    }
}
