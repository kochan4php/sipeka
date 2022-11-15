<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
  use HasFactory;

  // kasih tau tabel yang ada di databasenya
  protected $table = 'jurusan';

  // kasih tau primary key yang ada di tabel yang bersangkutan
  protected $primaryKey = 'id_jurusan';

  // set timestamps menjadi false, karena kalau pakai model otomatis dia memasukkan timestamps juga
  public $timestamps = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    //
  ];
}
