<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminBKK extends Model
{
  use HasFactory;

  // kasih tau tabel yang ada di databasenya
  protected $table = 'admin_bkk';

  // kasih tau primary key yang ada di tabel yang bersangkutan
  protected $primaryKey = 'id_admin';

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
    'id_admin',
    'id_user',
    'nama_admin',
    'nip'
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, 'id_user', 'id_user');
  }

  public function getRouteKeyName()
  {
    return 'id_admin';
  }
}
