<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Masyarakat extends Model {
  use HasFactory;

  // kasih tau tabel yang ada di databasenya
  protected $table = 'masyarakat';

  // kasih tau primary key yang ada di tabel yang bersangkutan
  protected $primaryKey = 'id_masyarakat';

  // set timestamps menjadi false, karena kalau pakai model otomatis dia memasukkan timestamps juga
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

  public function pelamar(): BelongsTo {
    return $this->belongsTo(Pelamar::class, 'id_pelamar', 'id_pelamar');
  }
}
