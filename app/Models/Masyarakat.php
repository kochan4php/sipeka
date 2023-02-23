<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Masyarakat extends Model {
    use HasFactory;

    /**
     * Set the table name
     *
     * @var string
     */
    protected $table = 'masyarakat';

    /**
     * Set the primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_masyarakat';

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
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat_tempat_tinggal',
        'no_telepon',
        'foto'
    ];

    /**
     * Satu masyarakat berperan sebagai satu pelamar
     *
     * @return BelongsTo
     */
    public function pelamar(): BelongsTo {
        return $this->belongsTo(Pelamar::class, 'id_pelamar', 'id_pelamar');
    }

    /**
     * Scope filter untuk pencarian
     *
     * @param Builder $q
     * @param string|null $filter
     * @return void
     */
    public function scopeFilter(Builder $q, ?string $filter): void {
        if ($filter) {
            $q->where('nama_lengkap', 'LIKE', "%{$filter}%")
                ->orWhereHas('pelamar', fn ($q) => $q->whereRelation('user', 'username', 'LIKE', "%{$filter}%"));
        }
    }
}
