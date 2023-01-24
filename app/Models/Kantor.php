<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kantor extends Model {
  use HasFactory, HasUuids;

  // kasih tau tabel yang ada di databasenya
  protected $table = 'kantor';

  // kasih tau primary key yang ada di tabel yang bersangkutan
  protected $primaryKey = 'id_kantor';

  // kasih tau kalau primary key nya bukan integer AI
  public $incrementing = false;

  // kasih tau kalau primary key nya bukan bertipe integer
  protected $keyType = 'string';

  protected $fillable = [
    'id_perusahaan',
    'alamat_kantor',
    'wilayah_kantor',
    'status_kantor',
    'no_telp_kantor',
    'kantor_utama'
  ];

  public function perusahaan(): BelongsTo {
    return $this->belongsTo(MitraPerusahaan::class, 'id_perusahaan', 'id_perusahaan');
  }

  public function getRouteKeyName(): string {
    return 'id_kantor';
  }
}
