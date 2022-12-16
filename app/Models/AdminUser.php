<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class AdminUser extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
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

    /**
     * checkPermissionAccess
     *
     * @param  $permissionCheck
     * @return boolean
     */
    public function checkPermissionAccess($permissionCheck)
    {
        $roles = Auth::user()->AdminRolesUser;
        foreach ($roles as $role) {
            $permissions = $role->rolePermissions;
            if ($permissions->contains('key_code', $permissionCheck)) {
                return true;
            }
        }
        return false;
    }
}
