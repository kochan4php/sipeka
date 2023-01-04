<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurusan extends Model {
  use HasFactory;

  // kasih tau tabel yang ada di databasenya
  protected $table = 'jurusan';

  // kasih tau primary key yang ada di tabel yang bersangkutan
  protected $primaryKey = 'id_jurusan';

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
    'id_jurusan',
    'nama_jurusan',
    'keterangan'
  ];

  public function alumni(): HasMany {
    return $this->hasMany(SiswaAlumni::class, 'id_jurusan', 'id_jurusan');
  }
}
