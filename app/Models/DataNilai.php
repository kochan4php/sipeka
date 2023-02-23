<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataNilai extends Model {
    use HasFactory, HasUuids;

    /**
     * Set the table name
     *
     * @var string
     */
    protected $table = 'data_nilai';

    /**
     * Set the primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_nilai';

    /**
     * Set the timestamps
     *
     * @var bool
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
     * Get the alumni that owns the DataNilai
     *
     * @return BelongsTo
     */
    public function alumni(): BelongsTo {
        return $this->belongsTo(SiswaAlumni::class, 'id_alumni', 'id_alumni');
    }
}
