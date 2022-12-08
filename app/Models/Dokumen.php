<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dokumen extends Model
{
  use HasFactory;

  // kasih tau tabel yang ada di databasenya
  protected $table = 'dokumen';

  // kasih tau primary key yang ada di tabel yang bersangkutan
  protected $primaryKey = 'id_dokumen';

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
    'id_jenis_dokumen',
    'nama_dokumen'
  ];

  public function dokumen_pengguna(): HasMany
  {
    return $this->hasMany(DokumenPengguna::class, 'id_jenis_dokumen', 'id_jenis_dokumen');
  }
}
