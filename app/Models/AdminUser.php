<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminUser extends Authenticatable
{
    use HasFactory, Notifiable ,SoftDeletes;
    protected $table = 'admin_users';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tel',
        'birthday',
        'gender',
    ];

    /**
     * hidden
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * AdminRolesUser
     *
     * @return Collection
     */
    public function AdminRolesUser()
    {
        return $this->belongsToMany(AdminRole::class, 'admin_role_user', 'user_id', 'role_id');
    }
}
