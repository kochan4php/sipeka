<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataNilai extends Model {
    use HasFactory, HasUuids;

    // kasih tau tabel yang ada di databasenya
    protected $table = 'data_nilai';

    // kasih tau primary key yang ada di tabel yang bersangkutan
    protected $primaryKey = 'id_nilai';

    // set timestamps menjadi false, karena kalau pakai model otomatis dia memasukkan timestamps juga
    public $timestamps = false;

    // kasih tau kalau primary key nya bukan integer AI
    public $incrementing = false;

    // kasih tau kalau primary key nya bukan bertipe integer
    protected $keyType = 'string';

    public function alumni(): BelongsTo {
        return $this->belongsTo(SiswaAlumni::class, 'id_alumni', 'id_alumni');
    }
}
