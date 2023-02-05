<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
  use HasApiTokens, HasFactory, Notifiable;

  // kasih tau tabel yang ada di databasenya
  protected $table = 'users';

  // kasih tau primary key yang ada di tabel yang bersangkutan
  protected $primaryKey = 'id_user';

  // set timestamps menjadi false, karena kalau pakai model otomatis dia memasukkan timestamps juga
  public $timestamps = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'id_level',
    'username',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function level_user(): BelongsTo {
    return $this->belongsTo(LevelUser::class, 'id_level', 'id_level');
  }

  public function admin(): HasOne {
    return $this->hasOne(AdminBKK::class, 'id_user', 'id_user');
  }

  public function perusahaan(): HasOne {
    return $this->hasOne(MitraPerusahaan::class, 'id_user', 'id_user');
  }

  public function pelamar(): HasOne {
    return $this->hasOne(Pelamar::class, 'id_user', 'id_user');
  }

  public function alumni(): HasOneThrough {
    return $this->hasOneThrough(
      SiswaAlumni::class,
      Pelamar::class,
      'id_user', // Foreign key di table pelamar
      'id_pelamar', // Foreign key di table siswa_alumni
      'id_user', // Local key / Primary Key di table users
      'id_pelamar' // Local key / Primary key di table pelamar
    );
  }

  public function masyarakat(): HasOneThrough {
    return $this->hasOneThrough(
      Masyarakat::class,
      Pelamar::class,
      'id_user', // Foreign key di table pelamar
      'id_pelamar', // Foreign key di table masyarakat
      'id_user', // Local key / Primary Key di table users
      'id_pelamar' // Local key / Primary key di table pelamar
    );
  }

  public function getRouteKeyName(): string {
    return 'username';
  }
}
