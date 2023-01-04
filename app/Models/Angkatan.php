<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Angkatan extends Model {
  use HasFactory;

  // kasih tau tabel yang ada di databasenya
  protected $table = 'angkatan';

  // kasih tau primary key yang ada di tabel yang bersangkutan
  protected $primaryKey = 'id_angkatan';

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
    'id_angkatan',
    'angkatan_tahun'
  ];

  public function alumni(): HasMany {
    return $this->hasMany(SiswaAlumni::class, 'id_angkatan', 'id_angkatan');
  }

  public function getRouteKeyName() {
    return 'id_angkatan';
  }
}
