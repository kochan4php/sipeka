<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotifikasiSeleksi extends Model {
	use HasFactory, HasUuids;

	// kasih tau tabel yang ada di databasenya
	protected $table = 'notifikasi_seleksi';

	// kasih tau primary key yang ada di tabel yang bersangkutan
	protected $primaryKey = 'id_notifikasi_seleksi';

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
		'id_pelamar',
		'pesan'
	];

	public function pelamar(): BelongsTo {
		return $this->belongsTo(Pelamar::class, 'id_pelamar', 'id_pelamar');
	}

	public function getRouteKeyName(): string {
		return 'id_notifikasi_seleksi';
	}
}
