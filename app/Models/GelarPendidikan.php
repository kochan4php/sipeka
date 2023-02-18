<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GelarPendidikan extends Model {
    use HasFactory, HasUuids;

    // kasih tau tabel yang ada di databasenya
    protected $table = 'gelar_pendidikan';

    // kasih tau primary key yang ada di tabel yang bersangkutan
    protected $primaryKey = 'id_gelar';

    // set timestamps menjadi false, karena kalau pakai model otomatis dia memasukkan timestamps juga
    public $timestamps = false;

    // kasih tau kalau primary key nya bukan integer AI
    public $incrementing = false;

    // kasih tau kalau primary key nya bukan bertipe integer
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_gelar'
    ];

    public function riwayat_pendidikan(): HasMany {
        return $this->hasMany(RiwayatPendidikan::class, 'kualifikasi', 'id_gelar');
    }
}
