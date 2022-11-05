<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable, HasApiTokens;
    const PASSWORD_DEFAULT = 'datn7878';
    const STATUS_BLOCK = 0;
    const STATUS_ACTIVE = 1;

    const FEMALE = 0;
    const MALE = 1;

    const GENDER = [
        self::MALE,
        self::FEMALE,
    ];
    protected $table = 'users';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'birthday',
        'gender',
        'status',
        'address',
        'city_id',
        'dist_id',
        'tel',
        'avatar',
        'created_at',
        'password',
    ];

    /**
     * hidden
     *
     * @var array
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
     * city
     *
     * @return Collection
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    /**
     * pref
     *
     * @return Collection
     */
    public function dist()
    {
        return $this->belongsTo(Dist::class, 'dist_id', 'id');
    }
}
