<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Set the table name
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Set the primary key
     *
     * @var string
     */
    protected $primaryKey = 'id_user';

    /**
     * Set the timestamps
     *
     * @var boolean
     */
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

    /**
     * Satu user hanya memiliki satu level
     *
     * @return BelongsTo
     */
    public function level_user(): BelongsTo {
        return $this->belongsTo(LevelUser::class, 'id_level', 'id_level');
    }

    /**
     * Satu user berperan sebagai admin
     *
     * @return HasOne
     */
    public function admin(): HasOne {
        return $this->hasOne(AdminBKK::class, 'id_user', 'id_user');
    }

    /**
     * Satu user berperan sebagai mitra
     *
     * @return HasOne
     */
    public function perusahaan(): HasOne {
        return $this->hasOne(MitraPerusahaan::class, 'id_user', 'id_user');
    }

    /**
     * Satu user berperan sebagai pelamar
     *
     * @return HasOne
     */
    public function pelamar(): HasOne {
        return $this->hasOne(Pelamar::class, 'id_user', 'id_user');
    }

    /**
     * Satu user berperan sebagai siswa alumni melalui pelamar
     *
     * @return HasOneThrough
     */
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

    /**
     * Satu user berperan sebagai masyarakat melalui pelamar
     *
     * @return HasOneThrough
     */
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

    /**
     * Set the route key name
     *
     * @return string
     */
    public function getRouteKeyName(): string {
        return 'username';
    }

    /**
     * Scope filter untuk pencarian alumni
     *
     * @param Builder $q
     * @param string|null $filter
     * @return void
     */
    public function scopeFilter(Builder $q, ?string $filter): void {
        if ($filter) {
            $q->where('username', 'LIKE', "%{$filter}%")
                ->orWhere('email', 'LIKE', "%{$filter}%")
                ->orWhereRelation('level_user', 'identifier', 'LIKE', "%{$filter}%");
        }
    }
}
